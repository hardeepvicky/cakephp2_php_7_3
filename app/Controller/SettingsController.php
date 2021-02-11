<?php
class SettingsController extends AppController
{

    public function admin_index()
    {
        
    }

    public function admin_save()
    {
        if ($this->request->is(array("post", "put")))
        {
            //debug($this->request->data); exit;
            $db = $this->{$this->modelClass}->getDataSource();
            $db->begin();

            try
            {
                $q = "TRUNCATE TABLE `settings`;";
                $this->{$this->modelClass}->query($q);

                foreach ($this->request->data["Setting"] as $name => $value)
                {
                    if (is_array($value))
                    {
                        $new_name = str_replace("_file", "", $name);
                        
                        if ($value['name'] != '')
                        {
                            if ($new_name == "company_logo" || $new_name == "company_logo_light" || $new_name == "pdf_logo")
                            {
                                $fileUtility = new FileUtility(1024 * 1024, array("jpg", "jpeg"));
                                
                                if (!$fileUtility->uploadFile($value, "files/", $new_name))
                                {
                                    throw new Exception(implode(", ", $fileUtility->errors));
                                }

                                $value = $fileUtility->path . $fileUtility->file . "?" . time();
                                
                                $record = $this->{$this->modelClass}->find("first", array(
                                    "conditions" => array(
                                        "name" => $new_name,
                                    )
                                ));

                                if ($record)
                                {
                                    $this->{$this->modelClass}->id = $record[$this->modelClass]['id'];
                                }
                                else
                                {
                                    $this->{$this->modelClass}->create();
                                }

                                $this->{$this->modelClass}->save(array(
                                    "name" => $new_name,
                                    "value" => $value
                                ));
                            }
                        }
                    }
                    else
                    {
                        $this->{$this->modelClass}->create();
                        $this->{$this->modelClass}->save(array(
                            "name" => $name,
                            "value" => $value
                        ));
                    }
                }

                $db->commit();
                $this->Session->setFlash('Setting has been saved.', 'flash_success');
                $this->redirect(array("action" => "save"));
            }
            catch (Exception $ex)
            {
                $db->rollback();
                $this->Session->setFlash($ex->getMessage(), 'flash_failure');
            }
        }

        $record_list = $this->{$this->modelClass}->find("list", array("fields" => array("name", "value")));

        $setting = array(
            "Global" => array(
                "Company Info" => [
                    ["label" => "Name", "name" => "company_name"],
                    ["label" => "Tag Line", "name" => "company_tag_line"],
                    [
                        "label" => "Logo",
                        "name" => "company_logo_light",
                        "attr" => [
                            "type" => "file",
                            "class" => "",
                            "required" => false
                        ],
                    ],
                    [
                        "label" => "Logo of Login Screen",
                        "name" => "company_logo",
                        "attr" => [
                            "type" => "file",
                            "class" => "",
                            "required" => false
                        ],
                    ],
                    [
                        "label" => "Logo of PDF",
                        "name" => "pdf_logo",
                        "attr" => [
                            "type" => "file",
                            "class" => "",
                            "required" => false
                        ],
                    ],
                    ["label" => "Address", "name" => "company_address" ],
                    ["label" => "Phone", "name" => "company_phone"],
                    ["label" => "Mobile", "name" => "company_mobile"],
                    ["label" => "Email", "name" => "company_email"],
                    ["label" => "GSTIN", "name" => "company_gst_no"],
                    ["label" => "PAN NO", "name" => "company_pan_no"],
                    ["label" => "TIN NO", "name" => "company_tin_no"],
                    ["label" => "Customer Care Mobile NO", "name" => "customer_care_mobile"],
                    ["label" => "Customer Care Email", "name" => "customer_care_email"],
                ],
                "Bank Info" => [
                    ["label" => "Bank", "name" => "company_bank_name"],
                    ["label" => "Branch", "name" => "company_bank_branch_name"],
                    ["label" => "IFSC", "name" => "company_bank_branch_ifsc"],
                    ["label" => "Account No", "name" => "company_bank_account"],
                ],
                "Quotation" => [
                    [
                        "label" => "Note", 
                        "name" => "quotation_note", 
                        "attr" => [
                            "required" => false
                        ]
                    ],
                    [
                        "label" => "Valid Upto Days", 
                        "name" => "quotation_valid_upto_days", 
                        'attr' => [
                            'type' => 'number'
                        ]
                    ],
                ],
                "Invoice" => [
                    ["label" => "Delivery Time", "name" => "invoice_delivery_time"],
                    [
                        "label" => "Sale Term and conditions",
                        "name" => "sale_term_and_conditions",
                        "attr" => [
                            "type" => "textarea",
                            "rows" => 5,
                            "required" => false
                        ],
                    ],
                    [
                        "label" => "Payment Terms",
                        "name" => "payment_terms",
                        "attr" => [
                            "type" => "textarea",
                            "rows" => 5,
                            "required" => false
                        ],
                    ],
                ],
                
                "Sale Order Note" => [
                    [
                        "label" => "Note", 
                        "name" => "sale_order_note", 
                        "attr" => [
                            "required" => false
                        ]
                    ],
                ],
            ),
        );

        $this->set(compact("setting", "record_list"));
    }

}
