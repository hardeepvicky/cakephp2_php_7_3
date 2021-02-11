<?php
class PincodesController extends AppController
{
    public function admin_index()
    {
        //Converts querystring to named parameter
        $this->Redirect->urlToNamed();

        // Sets Search Parameters
        $conditions = $this->getSearchConditions(array(
            array('model' => "City", 'field' => 'state_id', 'type' => 'int', 'view_field' => 'state_id'),
            array('model' => $this->modelClass, 'field' => 'city_id', 'type' => 'int', 'view_field' => 'city_id'),
            array('model' => $this->modelClass, 'field' => 'name', 'type' => 'string', 'view_field' => 'name'),
        ));
        
        $this->{$this->modelClass}->contain(array(
            "City" => array()
        ));

        $records = $this->paginate($this->modelClass, $conditions);
        
        $state_list = $this->{$this->modelClass}->City->State->getListCache();

        //setting variables
        $this->set(compact('records', "state_list"));
        
        $this->afterIndex();
    }
    
    public function admin_delete($id)
    {
        $this->delete($id, array("action" => "admin_index"));
    }
    
    public function admin_import()
    {
        AWSFileUtility::validateConfig();

        $sample = "samples/pincode.csv";

        if ($this->request->is(array("post", "put")))
        {
            try
            {
                AppModel::$historyLog = false;
                ini_set('max_execution_time', 900);
                ini_set("memory_limit", "1024M");

                $fileUtility = new FileUtility(1024 * 1024 * 50, array("csv"));

                $this->request->data[$this->modelClass]['file']['name'] = "pincode." . pathinfo($this->request->data[$this->modelClass]['file']['name'], PATHINFO_EXTENSION);

                if (!$fileUtility->uploadFile($this->request->data[$this->modelClass]['file'], PATH_IMPORT_LOG))
                {
                    throw new Exception(implode(", ", $fileUtility->errors));
                }

                $importUtility = new ImportUtility($sample, PATH_IMPORT_LOG . $fileUtility->file);

                if (!$importUtility->checkHeaders())
                {
                    $this->set(array('errors' => $importUtility->errors));
                    throw new Exception("CSV Column headers are mismatched");
                }

                $headers = array(
                    "pincode" => "name",
                    "city" => "city_id",      
                    "state" => "state",      
                );

                $data = $importUtility->replaceHeaders($headers);

                $total_count = count($data);

                $file = PATH_IMPORT_LOG . $fileUtility->file;

                if (FileUtility::use_s3)
                {
                    $aws = new AWSFileUtility();
                    if (!$aws->move($file, PATH_IMPORT_LOG))
                    {
                        throw new Exception("Failed to move file to AWS : " . $fileUtility->file);
                    }

                    $file = PATH_IMPORT_LOG . $aws->file;
                }

                $this->load_model("ImportLog");
                $this->ImportLog->create();
                $this->ImportLog->save(array(
                    'ImportLog' => array(
                        "type" => ImportLogTypes::PINCODE,
                        "file" => $file,
                        "total_count" => $total_count
                    )
                ));

                $this->set("import_log_id", $this->ImportLog->id);

                $city_records = $this->{$this->modelClass}->City->findCache();
                $state_list = $this->{$this->modelClass}->City->State->getListCache();
                $state_city_list = array();
                foreach ($city_records as $arr)
                {
                    $key = strtoupper(trim($state_list[$arr["City"]["state_id"]])) . "-" . strtoupper(trim($arr["City"]["name"]));
                    $state_city_list[$key] = $arr["City"]["id"];
                }
                
                //debug($state_city_list); debug($data); exit;

                $errors = array();

                $accepted_count = 0;
                foreach ($data as $i => $record)
                {
                    $validate = TRUE;
                    
                    $key = strtoupper(trim($record["state"])) . "-" . strtoupper(trim($record["city_id"]));
                    
                    if (isset($state_city_list[$key]))
                    {
                        $record["city_id"] = $state_city_list[$key];
                    }
                    else
                    {
                        $errors[] = "Row #" . ($i + 2) . " Wrong City : " . $record["city_id"] . " and State : " . $record['state'];
                        $validate = false;
                    }

                    if ($validate)
                    {
                        if ($this->{$this->modelClass}->saveOrUpdate($record))
                        {
                            $accepted_count++;
                        }
                        else
                        {
                            if ($this->{$this->modelClass}->validationErrors)
                            {
                                foreach ($this->{$this->modelClass}->validationErrors as $field => $err)
                                {
                                    $errors[] = "Row #" . ($i + 2) . " Save Failed : " . implode(",", $err);
                                }
                            }
                        }
                    }
                }

                $this->ImportLog->saveField("accept_count", $accepted_count);

                $record_highlight_text = "Total Count = $total_count, Accepted Count = $accepted_count";

                if ($errors)
                {
                    $this->ImportLog->saveField("error_log", implode("\n", $errors));

                    $this->set(compact("errors"));
                    throw new Exception("Unable to Save all records. $record_highlight_text");
                }

                $this->Session->setFlash("All File rows updated successfully. $record_highlight_text", "flash_success");
            }
            catch (Exception $ex)
            {
                $this->Session->setFlash($ex->getMessage(), 'flash_failure');
            }
        }

        $this->set(compact('sample'));
        $this->render("admin_import");
    }
}