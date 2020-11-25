<?php
/**
 * @created    08-03-2017
 * @author     Hardeep
 */
class BaseController extends Controller 
{
    protected function _queryLog()
    {
        $dbo = $this->{$this->modelClass}->getDatasource();
        return $dbo->getLog();
    }
    
    protected function _queryLastLog()
    {
        $logs = $this->_queryLog();
        $lastLog = end($logs['log']);
        return $lastLog['query'];
    }
    
    //function to prevent load model more than 2 times
    protected function load_model($model)
    {
        if (!in_array($model, $this->uses, true)) 
        {
            $this->loadModel($model);
        }
    }
    
    protected function _getNotifications($user_id)
    {
        $this->load_model("Notification");
        
        $notifications = $this->Notification->find("all", array(
            "conditions" => array(
                "will_shown" => 1,
                "to_user_id" => $user_id
            ),
            "contain" => array(
                "User" => array(
                    "fields" => array("id", "group_id", "name")
                )
            ),
            "order" => "Notification.id DESC",
            "limit" => 20
        ));
        
        return $notifications;
    }
    
    protected function _setMysqlIndianTimeZone($model = null)
    {
        if (!$model)
        {
            $model = $this->modelClass;
        }
        
        $q = "SET SESSION time_zone = '+5:30'";
        
        $this->{$model}->query($q);
    }
    
    public function ajaxSaveField()
    {
        if ( !isset($this->request->data["pk"]) )
        {
            throw new NotFoundException(__('pk is missing in post '));
        }
        
        $count = $this->{$this->modelClass}->find("count", array("conditions" => array("id" => $this->request->data["pk"])));
        
        if ($count == 0)
        {
            throw new NotFoundException(__('Invalid ' . $this->modelClass));
        }
        
        $this->{$this->modelClass}->id = $this->request->data["pk"];
        $this->{$this->modelClass}->saveField($this->request->data["name"], $this->request->data["value"]);
        
        echo 1; exit;
    }
    
    protected function _saveSqlLog($model = null)
    {
        if (!$model)
        {
            $model = $this->modelClass;
        }
        
        $dbo = $this->{$model}->getDatasource();
        $log = $dbo->getLog(false, false);        
        
        if (!$log["count"])
        {
            return;
        }
        
        $data = array(
            "controller" => $this->params['controller'],
            "action" => $this->params['action'],
            "url" => $this->params->url,
            "have_heavy_query" => false
        );
        
        $sql_list = $heavy_sql_list =  array(
            implode(",", array("query", "affected", "numRows", "took") )
        );
        
        $dml_sql_list = [];

        foreach($log["log"] as $arr)
        {
            unset($arr["params"]);            
            $arr["query"] = trim(preg_replace('/\s+/', ' ', $arr["query"]));
            $sql_list[] = implode(",", array_values($arr) );
            
            if ($arr['took'] > 500)
            {
                $data['have_heavy_query'] = true;
                $heavy_sql_list[] = implode(",", array_values($arr) );
            }
            
            $is_insert = strpos($arr["query"], "INSERT");
            $is_update = strpos($arr["query"], "UPDATE");
            $is_delete = strpos($arr["query"], "DELETE");
            
            if ($is_insert !== FALSE || $is_update !== FALSE || $is_delete !== FALSE) 
            {
                $dml_sql_list[] = $arr["query"];
            }
        }

        $data["sql_count"] = $log["count"];
        $data["sql_exec_time"] = $log["time"] / 1000;
        $data["sql_log"] = implode(PHP_EOL, $sql_list);
        $data["dml_sql_log"] = implode(PHP_EOL, $dml_sql_list);
        if ($data['have_heavy_query'])
        {
            $data["heavy_sql_log"] = implode(PHP_EOL, $heavy_sql_list);
        }
        
        $this->load_model("SqlLog");
        $this->SqlLog->create();
        $this->SqlLog->save($data);
    }
    
    protected function _saveRequestLog($post = [], $response = "", $model = null)
    {
        $this->_saveSqlLog($model);
        
        $data = [];
        $data["post_data"] = json_encode($post);
        $data["response"] = $response;
        
        $this->SqlLog->save($data);
    }
    
    protected function jsonResonse($response, $save_log = true, $model = null)
    {
        $json = json_encode($response);
                
        if ($save_log)
        {
            $this->_saveRequestLog($this->request->data, $json, $model);
        }
        
        echo $json; exit;
    }
    
    protected function setLargeMemnory($model = null)
    {
        set_time_limit(0);
        ini_set("memory_limit", "2024M");
        ini_set("default_socket_timeout", 7200);
        
        $this->{$model}->query("SET session wait_timeout=28800");
        $this->{$model}->query("SET session interactive_timeout=28800");
        $this->{$model}->query("SET session net_read_timeout=28800");
        $this->{$model}->query("SET session net_write_timeout=28800");
    }
}