<?php
class TypesController extends AppController
{
    public function admin_index()
    {
        //Converts querystring to named parameter
        $this->Redirect->urlToNamed();

        // Sets Search Parameters
        $conditions = $this->getSearchConditions(array(
            array('model' => $this->modelClass, 'field' => array('type'), 'type' => 'integer', 'view_field' => 'type'),
            array('model' => $this->modelClass, 'field' => array('name'), 'type' => 'string', 'view_field' => 'name'),
            array('model' => $this->modelClass, 'field' => array('code'), 'type' => 'integer', 'view_field' => 'code')
        ));

        $records = $this->paginate($this->modelClass, $conditions);
        
        $this->_setList();

        //setting variables
        $this->set(compact('records'));
        
        $this->afterIndex();
    }

    public function admin_add()
    {
        parent::add(array("action" => "admin_index"));
        $this->_setList();
        $this->render('admin_form');
    }

    public function admin_edit($id)
    {
        parent::edit($id, array("action" => "admin_index"));
        $this->_setList();
        $this->render('admin_form');
    }
    
    public function admin_copy($id)
    {
        parent::copy($id, array("action" => "admin_index"));
        $this->_setList();
        $this->render('admin_form');
    }
    
    private function _setList()
    {
        $type_list = array_merge(array(ProductAttrTypes::COLOR => "Color"), ProductAttrTypes::getDropdownFields());
        $this->set(compact("type_list"));
    }

    public function admin_delete($id)
    {
        $this->delete($id, array("action" => "admin_index"));
    }
    
    public function admin_import()
    {
        AWSFileUtility::validateConfig();

        if ($this->request->is(array("post", "put")))
        {
            $sample = "samples/type.csv";
            try
            {
                ini_set('max_execution_time', 900);
                ini_set("memory_limit", "1024M");

                $fileUtility = new FileUtility(1024 * 1024 * 50, array("csv"));

                $this->request->data[$this->modelClass]['file']['name'] = "type." . pathinfo($this->request->data[$this->modelClass]['file']['name'], PATHINFO_EXTENSION);

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
                    "Type" => "type",
                    "Name" => "name",
                    "Code" => "code",
                    "Value" => "value",
                    "Display Order" => "display_order",
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
                        "type" => ImportLogTypes::TYPE,
                        "file" => $file,
                        "total_count" => $total_count
                    )
                ));

                $this->set("import_log_id", $this->ImportLog->id);

                $errors = array();
                $accepted_count = 0;
                foreach ($data as $i => $record)
                {
                    $validate = TRUE;
                    
                    if ( !isset(ProductAttrTypes::$list[$record["type"]]) )
                    {
                        $errors[] = "Row #" . ($i + 2) . " Wrong Type : " . $record["type"];
                        $validate = FALSE;
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
                                    $errors[] = "Row #" . ($i + 2) . " Save Fail : " . implode(",", $err);
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
        
        $sample = Router::url(["controller" => "Samples", "action" => "admin_type"]);

        $this->set(compact('sample'));
        $this->render("admin_import");
    }
}