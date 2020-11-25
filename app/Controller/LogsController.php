<?php
/**
 * Web Service Logs Controller
 * 
 * @created    08-03-2017
 * @license    Proprietary
 * @author     Hardeep
 */
class LogsController extends AppController 
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        
        ini_set("max_execution_time", 180);
        ini_set("memory_limit", "1024M");
        
        AWSFileUtility::validateConfig();
        
        $this->Auth->allow(array("downloadWebServiceLog", "downloadCronJobLog", "downloadSqlLog", "ajaxApiImportSummary", "ajaxSaveFrontendErrors", "downloadFrontendError", "uncommerce_api_logs"));
    }
    
    public function admin_web_services()
    {
        $this->Redirect->urlToNamed();
        
        $model = "ViewWebServiceLog";
        $this->loadModel($model);
        
        $web_service_types = $this->{$model}->web_service_types;
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'type', 'type' => 'integer', 'view_field' => 'type'),
            array('model' => $model, 'field' => 'status', 'type' => 'integer', 'view_field' => 'status'),
            array('model' => $model, 'field' => 'user_id', 'type' => 'integer', 'view_field' => 'user_id'),
            array('model' => $model, 'field' => 'request', 'type' => 'string', 'view_field' => 'request'),
            array('model' => $model, 'field' => 'response', 'type' => 'string', 'view_field' => 'response'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->{$model}->recursive = -1;        
        $records = $this->paginate($model, $conditions);
        
        $this->load_model("User");
        $user_list = $this->User->getListCache();
        
        $this->set(compact('records', "web_service_types", "model", "user_list"));
        
        $this->afterIndex();
    }
    
    public function downloadWebServiceLog($id, $field, $ext = "json")
    {
        if ( !$id )
        {
            throw new Exception("Missing id");
        }
        
        if ( !$field )
        {
            throw new Exception("Missing field");
        }
        
        $this->loadModel("WebServiceLog");
        
        $record = $this->WebServiceLog->findById($id, array("fields" => $field));
        
        if ( !$record )
        {
            throw new Exception("Invalid Web Service Log");
        }
        
        if ( !$record["WebServiceLog"][$field] )
        {
            die("Have no $field");
        }
        
        FileUtility::createFolder(PATH_TEMP);
        $file = PATH_TEMP . "web_service_log_" . $id . "_$field.$ext";        
        
        file_put_contents($file, $record["WebServiceLog"][$field]);
        download_start($file, 'application/octet-stream');
    }    
    
    public function admin_crons()
    {
        $this->Redirect->urlToNamed();
        
        $model = "CronLog";
        
        $this->loadModel($model);
        
        $cron_types = array(
            CRON_DAILY_12AM => "Daily 12 AM",
            CRON_DAILY_1_AM => "Daily 1 AM",
            CRON_DAILY_2_AM => "Daily 2 AM",
            CRON_DAILY_3_AM => "Daily 3 AM",
            CRON_EVERY_HOUR => "Every Hours",
            CRON_EVERY_6_HOUR => "Every 6 Hour",
            CRON_EVERY_15_MINTUE => "Every 15 Mintue",
            CRON_EVERY_1_MINTUE => "Every 1 Mintue",
            CRON_EVERY_5_MINTUE => "Every 5 Minute",
            CRON_EVERY_15_DAYS => "Every 15 Days",
            CRON_EVERY_MONTH => "Every Month"
        );
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'type', 'type' => 'integer', 'view_field' => 'type'),
            array('model' => $model, 'field' => 'status', 'type' => 'integer', 'view_field' => 'status'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        
        $this->{$model}->recursive = -1;
        $this->paginate["fields"] = array("id", "type", "description", "status", "sql_count", "sql_exec_time", "created");
        $this->paginate["limit"] = 50;
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records', "cron_types", "model"));
        
        $this->afterIndex();
    }
    
    public function downloadCronJobLog($id, $field, $ext = "json")
    {
        if ( !$id )
        {
            throw new Exception("Missing id");
        }
        
        if ( !$field )
        {
            throw new Exception("Missing field");
        }
        
        $this->loadModel("CronLog");
        
        $record = $this->CronLog->findById($id, array("fields" => $field));
        
        if ( !$record )
        {
            throw new Exception("Invalid Cron Log");
        }
        
        if ( !$record["CronLog"][$field] )
        {
            die("Have no $field");
        }
        
        FileUtility::createFolder(PATH_TEMP);
        $file = PATH_TEMP . "cron_log_" . $id . "_$field.$ext";
        
        file_put_contents($file, $record["CronLog"][$field]);
        download_start($file, 'application/octet-stream');
    }    
    
    
    public function admin_notifications()
    {
        $this->Redirect->urlToNamed();
        
        $model = "Notification";
        $this->loadModel($model);
        
        $types = Notification::$types;
        
        $sub_type_list = Notification::$sub_type_list;
        
        $push_noti_types = $this->{$model}->PushNotificationLog->types;
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'type', 'type' => 'integer', 'view_field' => 'type'),
            array('model' => $model, 'field' => 'sub_type', 'type' => 'integer', 'view_field' => 'sub_type'),
            array('model' => $model, 'field' => array("title", "detail"), 'type' => 'string', 'view_field' => 'name'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        
        $this->{$model}->contain(array(
            "PushNotificationLog" => array(
                "fields" => array("type", "is_sent")
            )
        ));
        
        $conditions["Notification.will_shown"] = 1;
        $conditions["Notification.to_user_id"] = $this->authUser["id"];
        $this->paginate["limit"] = 100;
        $records = $this->paginate($model, $conditions);
        
        $user_list = $this->{$model}->User->getListCache();
        
        $this->set(compact('records', "types", "push_noti_types",  "model", "user_list", "sub_type_list"));
        
        $this->afterIndex();
    }
    
    public function admin_push_notification_logs()
    {
        $this->Redirect->urlToNamed();
        
        $model = "PushNotificationLog";
        
        $this->loadModel($model);
        
        $types = $this->{$model}->types;
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'type', 'type' => 'integer', 'view_field' => 'type'),
            array('model' => "Notification", 'field' => 'to_user_id', 'type' => 'integer', 'view_field' => 'to_user_id'),
            array('model' => $model, 'field' => 'is_sent', 'type' => 'integer', 'view_field' => 'is_sent'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->paginate["limit"] = 100;
        $this->paginate["contain"] = array(
            "Notification" => array()
        );
            
        if (!in_array($this->authUser["group_id"], array(GROUP_ADMIN)))
        {
            $conditions["Notification.to_user_id"] = $this->authUser["id"];
        }
        
        $records = $this->paginate($model, $conditions);
        
        $this->load_model("User");
        $user_list = $this->User->getListCache();
        
        $this->set(compact('records', "types", "model", "user_list"));
        
        $this->afterIndex();
    }
    
    public function admin_autoIncrements()
    {
        $model = "AutoIncrement";
        
        $this->load_model($model);
        
        $records = $this->AutoIncrement->find("all");
        
        $this->set(compact('records', 'model'));   
    }
	
	/* Unicommerce api logs Code start here*/
	
	public function admin_unicommerce_api_logs()
    {
		$this->Redirect->urlToNamed();
        
        $model = "UnicommerceApiInventoryRecord";
        $this->loadModel($model);
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'status', 'type' => 'integer', 'view_field' => 'status'),
           ));
        
        $this->{$model}->recursive = -1;        
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records',"model"));
        
        $this->afterIndex();		
    }
    /* Unicommerce api logs Code end here*/
	
    public function admin_import_logs()
    {
        $this->Redirect->urlToNamed();
        
        $model = "ImportLog";
        
        $this->loadModel($model);
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'type', 'type' => 'integer', 'view_field' => 'type'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->{$model}->recursive = -1;
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records', "model"));
        
        $this->afterIndex();
    }
    
    public function admin_download_import_error_log($id)
    {
        $this->loadModel('ImportLog');
        
        $record = $this->ImportLog->findById($id);
        
        $path = "files/temp/";
        FileUtility::createFolder($path);
        $file = $record['ImportLog']['type'] . "-" . time() . ".txt";
        
        file_put_contents($path . $file, $record['ImportLog']['error_log']);
        download_start($file, 'application/octet-stream');
    }
    
    public function admin_history_logs()
    {
        $this->Redirect->urlToNamed();
        
        $model = "HistoryLog";
        
        $this->loadModel("User");
        
        $user_list = $this->User->getListCache("id", "name");
        
        $this->loadModel($model);
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'activity', 'type' => 'string', 'view_field' => 'activity'),
            array('model' => $model, 'field' => 'detail', 'type' => 'string', 'view_field' => 'detail'),
            array('model' => $model, 'field' => 'created_by', 'type' => 'integer', 'view_field' => 'created_by'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->{$model}->recursive = -1;
        $this->paginate["limit"] = 50;
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records', "model", 'user_list'));
        
        $this->afterIndex();
    }
    
    public function admin_email_logs()
    {
        $this->Redirect->urlToNamed();
        
        $model = "EmailLog";
        
        $this->loadModel($model);
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'code', 'type' => 'integer', 'view_field' => 'code'),
            array('model' => $model, 'field' => 'from_email', 'type' => 'string', 'view_field' => 'from_email'),
            array('model' => $model, 'field' => 'to_email', 'type' => 'string', 'view_field' => 'to_email'),
            array('model' => $model, 'field' => array('subject', 'body'), 'type' => 'string', 'view_field' => 'subject_body'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->{$model}->recursive = -1;
        $this->paginate["limit"] = 50;
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records', "model"));
        
        $this->afterIndex();
    }
    
    public function admin_sql_logs()
    {
        $this->Redirect->urlToNamed();
        
        $model = "SqlLog";
        
        $this->loadModel($model);
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'controller', 'type' => 'int', 'view_field' => '_controller'),
            array('model' => $model, 'field' => 'action', 'type' => 'int', 'view_field' => '_action'),
            array('model' => $model, 'field' => 'url', 'type' => 'string', 'view_field' => 'url'),
            array('model' => $model, 'field' => 'have_heavy_query', 'type' => 'int', 'view_field' => 'have_heavy_query'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->{$model}->recursive = -1;
        $this->paginate["fields"] = array("id", "controller", "action", "url", "sql_count", "sql_exec_time", "have_heavy_query", "created", "created_by");
        $this->paginate["limit"] = 50;
        $records = $this->paginate($model, $conditions);
        
        $this->load_model("User");
        $user_list = $this->User->getListCache();
        
        $this->set(compact('records', "model", "user_list"));
        
        $this->afterIndex();
    }
    
    public function downloadSqlLog($id, $field, $ext = "txt")
    {
        if ( !$id )
        {
            throw new Exception("Missing id");
        }
        
        if ( !$field )
        {
            throw new Exception("Missing field");
        }
        
        $this->loadModel("SqlLog");
        
        $record = $this->SqlLog->findById($id, array("fields" => $field));
        
        if ( !$record )
        {
            throw new Exception("Invalid Sql Log");
        }
        
        if ( !$record["SqlLog"][$field] )
        {
            die("Have no $field");
        }
        
        FileUtility::createFolder(PATH_TEMP);
        $file = PATH_TEMP . "sql_log_" . $id . ".$ext";
        
        file_put_contents($file, $record["SqlLog"][$field]);
        download_start($file, 'application/octet-stream');
    }  
    
    public function admin_api_imports()
    {
        $this->Redirect->urlToNamed();
        
        $model = "ApiImport";
        
        $this->loadModel($model);
        
        $types = ApiImport::$list;
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'type', 'type' => 'integer', 'view_field' => 'type'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->{$model}->recursive = -1;
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records', "types", "model"));
        
        $this->afterIndex();
    }
    
    public function admin_api_import_tree()
    {
        $this->Redirect->urlToNamed();
        
        $model = "ApiImport";
        
        $this->loadModel($model);
        
        $types = ApiImport::$list;
        
        $conditions["parent_id"] = 0;
        $this->{$model}->recursive = -1;
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records', "types", "model"));
        
        $this->afterIndex();
    }
    
    public function ajaxApiImportSummary($parent_id)
    {
        $this->Redirect->urlToNamed();
        
        $model = "ApiImport";
        
        $this->loadModel($model);
        
        $types = ApiImport::$list;
        
        $conditions["parent_id"] = $parent_id;
        
        $this->{$model}->recursive = -1;
        $records = $this->{$model}->find("all", array(
            "conditions" => $conditions
        ));
        
        $this->set(compact('records', "types", "model"));        
    }
    
    public function ajaxSaveFrontendErrors()
    {
        $response = array("status" => 0);
        try
        {
            $this->request->data["auth"] = "<pre>" . json_encode($this->request->data["auth"], JSON_PRETTY_PRINT) . "</pre>";
            $this->load_model("FrontendError");
            $this->FrontendError->create();
            $this->FrontendError->save($this->request->data);
            
            $response = array("status" => 1);
        }
        catch(Exception $ex)
        {
            $response["status"] = 0;
            $response["msg"] = $ex->getMessage();
        }
        
        echo json_encode($response); exit;
    }
    
    public function admin_frontend_errors()
    {
        $this->Redirect->urlToNamed();
        
        $model = "FrontendError";
        $this->loadModel($model);
        
        $conditions = $this->getSearchConditions(array(
            array('model' => $model, 'field' => 'url', 'type' => 'integer', 'view_field' => 'url'),
            array('model' => $model, 'field' => 'error_code', 'type' => 'integer', 'view_field' => 'error_code'),
            array('model' => $model, 'field' => 'created', 'type' => 'from_date', 'view_field' => 'from_date'),
            array('model' => $model, 'field' => 'created', 'type' => 'to_date', 'view_field' => 'to_date'),
        ));
        
        $this->{$model}->recursive = -1;
        $this->paginate["fields"] = array("id", "url", "error_code", "error_msg", "created");
        $this->paginate["limit"] = 50;
        $records = $this->paginate($model, $conditions);
        
        $this->set(compact('records', "model"));
        
        $this->afterIndex();
    }
    
    public function downloadFrontendError($id, $field, $ext = "txt")
    {
        if ( !$id )
        {
            throw new Exception("Missing id");
        }
        
        if ( !$field )
        {
            throw new Exception("Missing field");
        }
        
        $this->loadModel("FrontendError");
        $record = $this->FrontendError->findById($id, array("fields" => $field));
        
        if ( !$record )
        {
            throw new Exception("Invalid Log");
        }
        
        if ( !$record["FrontendError"][$field] )
        {
            die("Have no $field");
        }
        
        FileUtility::createFolder(PATH_TEMP);
        $file = PATH_TEMP . "frontend_error_log_" . $id . ".$ext";
        
        file_put_contents($file, $record["FrontendError"][$field]);
        download_start($file, 'application/octet-stream');
    }  
    
    public function admin_request_chart()
    {
        
    }
    
    public function ajaxRequestChart()
    {
        
    }
}