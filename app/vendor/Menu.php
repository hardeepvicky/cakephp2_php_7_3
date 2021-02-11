<?php
namespace Menu;

abstract class MenuItem
{
    protected $controller;
    
    abstract public function get();
    
    public function link($action)
    {
        return [
            'controller' => $this->controller,
            'action' => $action,
            'admin' => true
        ];
    }
    
    public function otherLink($title, $action, $icon_class = null)
    {
        if ( !$icon_class ) 
        {
            $icon_class = \Icon::SUMMARY;
        }
        
        return [
            'title' => $title,
            'controller' => $this->controller,
            'action' => $action,
            'admin' => true,
            'icon_class' => $icon_class
        ];
    }
    
    
    public function menuItem($title, $action, $icon_class = null, $other_links = [])
    {
        if ( !$icon_class ) 
        {
            $icon_class = \Icon::SUMMARY;
        }
        
        return [
            'title' => $title,
            'icon_class' => $icon_class,
            'link' => $this->link($action),
            'other_links' => $other_links
        ];
    }
    
    public function getCommonCrud()
    {
        return [
            "index" => $this->menuItem("Summary", "index", \Icon::SUMMARY, [
                $this->otherLink("View", "view", \Icon::VIEW),
            ]),
            
            "add" => $this->menuItem("Add", "add", \Icon::ADD, [
                $this->otherLink("Edit", "edit", \Icon::EDIT),
                $this->otherLink("Copy", "copy", \Icon::COPY),
            ]),
        ];
    }
    
}

class Main
{    
    public static function get($acl, $group_id)
    {
        $menu = [];
        
        $menu[] = (new Home)->get();  
        $menu[] = (new SystemManager)->get();
        $menu[] = (new GeneralManager)->get();
        $menu[] = (new MemberManagement)->get();
        $menu[] = (new LogManager)->get();
        
        //return $menu;
        return self::onlyAllowed($menu, $acl, $group_id);
    }
    
    private static function onlyAllowed($main_menu, $acl, $group_id)
    {
        if (!$group_id)
        {
            return array();
        }

        $menus = array();

        foreach ($main_menu as $k => $submenu)
        {
            if (isset($submenu['link']))
            {
                $action = $submenu['link']['action'];

                if (isset($submenu['link']['admin']) && $submenu['link']['admin'] && strpos($action, "admin_") == FALSE)
                {
                    $action = "admin_$action";
                }

                $url = $submenu['link']['controller'] . "/" . $action;
                
                if ($acl->check(array("model" => "Group", "foreign_key" => $group_id), $url))
                {
                    $menus[$k] = $submenu;
                }
            }
            else if (isset($submenu['links']))
            {
                $menus[$k] = $submenu;
                
                $menus[$k]['links'] = self::onlyAllowed($submenu['links'], $acl, $group_id);
                if (empty($menus[$k]['links']))
                {
                    unset($menus[$k]);
                }
            }
            else
            {
                debug($submenu);
            }
        }

        return $menus;
    }

    public static function getDefaultLink($menus)
    {
        foreach ($menus as $k => $menu)
        {
            foreach ($menu["links"] as $key => $submenu)
            {
                if ( isset($submenu["link"]) )
                {
                    if (strtolower($key) == "default")
                    {
                        return $submenu["link"];
                    }
                }
                else if ($submenu["links"])
                {
                    return self::getDefaultLink($submenu["links"]);
                }
            }
        }
    }

    public static function getBreadcum($menus, $controller, $action)
    {
        $breadcum = array();
        $controller = \Inflector::camelize($controller);
        foreach ($menus as $menu)
        {
            foreach ($menu["links"] as $sub_menu)
            {
                if (isset($sub_menu['link']))
                {
                    if (isset($sub_menu['link']['admin']) && $sub_menu['link']['admin'])
                    {
                        if (strpos($sub_menu['link']['action'], "admin_") == FALSE)
                        {
                            $sub_menu['link']['action'] = "admin_" . $sub_menu['link']['action'];
                        }
                    }

                    if ($controller == $sub_menu['link']['controller'] && $action == $sub_menu['link']['action'])
                    {
                        $breadcum = array(
                            array("title" => $menu['title'], 'icon_class' => $menu['icon_class']),
                            array("title" => $sub_menu['title'], 'icon_class' => $sub_menu['icon_class']),
                        );

                        return $breadcum;
                    }
                    else if (isset($sub_menu['other_links']))
                    {
                        foreach ($sub_menu['other_links'] as $other_link)
                        {
                            if (strpos($other_link['action'], "admin_") == FALSE)
                            {
                                $other_link['action'] = "admin_" . $other_link['action'];
                            }

                            if ($controller == $other_link['controller'] && $action == $other_link['action'])
                            {
                                $breadcum = array(
                                    array("title" => $menu['title'], 'icon_class' => $menu['icon_class']),
                                    array("title" => $other_link['title'], 'icon_class' => ''),
                                );

                                return $breadcum;
                            }
                        }
                    }
                }
                else if (isset($sub_menu['links']))
                {
                    foreach ($sub_menu['links'] as $sub_menu2)
                    {
                        if (isset($sub_menu2['link']['admin']) && $sub_menu2['link']['admin'])
                        {
                            if (strpos($sub_menu2['link']['action'], "admin_") == FALSE)
                            {
                                $sub_menu2['link']['action'] = "admin_" . $sub_menu2['link']['action'];
                            }
                        }

                        if ($controller == $sub_menu2['link']['controller'] && $action == $sub_menu2['link']['action'])
                        {
                            $breadcum = array(
                                array("title" => $menu['title'], 'icon_class' => $menu['icon_class']),
                                array("title" => $sub_menu['title'], 'icon_class' => $sub_menu['icon_class']),
                                array("title" => $sub_menu2['title'], 'icon_class' => $sub_menu2['icon_class']),
                            );

                            return $breadcum;
                        }
                        else if (isset($sub_menu2['other_links']))
                        {
                            foreach ($sub_menu2['other_links'] as $other_link)
                            {
                                if (strpos($other_link['action'], "admin_") == FALSE)
                                {
                                    $other_link['action'] = "admin_" . $other_link['action'];
                                }

                                if ($controller == $other_link['controller'] && $action == $other_link['action'])
                                {
                                    $breadcum = array(
                                        array("title" => $menu['title'], 'icon_class' => $menu['icon_class']),
                                        array("title" => $sub_menu['title'], 'icon_class' => $sub_menu['icon_class']),
                                        array("title" => $other_link['title'], 'icon_class' => ''),
                                    );

                                    return $breadcum;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


class Home extends MenuItem
{
    public function get()
    {
        $submenu =  [
            "title" => "Home",
            "icon_class" => \Icon::MODULE,
            "links" => []
        ];
        
        $submenu['links']["default"] = [
            'title' => 'Dashboard',
            'icon_class' => \Icon::DASHBOARD,
            'link' => [
                'controller' => 'Dashboards',
                'action' => 'index',
                'admin' => true
            ],
        ];
        
        $submenu['links'][] = [
            'title' => 'Permissions',
            'icon_class' => \Icon::WORK,
            'link' => [
                'controller' => 'Users',
                'action' => 'permissions',
                'admin' => true
            ],
        ];
        
        return $submenu;
    }
    
}

class SystemManager extends MenuItem
{
    public function get()
    {
        $submenu =  [
            "title" => "System Manager",
            "icon_class" => \Icon::MODULE,
            "links" => []
        ];
        
        $submenu['links'][] = $this->EmailTemplate();
        return $submenu;
    }
    
    private function EmailTemplate()
    {
        $this->controller = "EmailTemplates";
        
        $submenu = [
            "title" => "Email Template",
            "icon_class" => \Icon::SUB_MODULE,
            "links" => []
        ];
        
        $submenu['links']["default"] = $this->menuItem("Summary", "index", \Icon::SUMMARY, [
            $this->otherLink("Add", "add"),
            $this->otherLink("Edit", "edit"),
            $this->otherLink("Copy", "copy"),
        ]);
        
        return $submenu;
    }
}


class GeneralManager extends MenuItem
{
    public function get()
    {
        $submenu =  [
            "title" => "General Manager",
            "icon_class" => \Icon::MODULE,
            "links" => []
        ];
        
        $this->controller = "States";
        $submenu['links'][] = $this->menuItem("State", "index");
        
        $this->controller = "Cities";
        $submenu['links'][] = [
            "title" => "City",
            "icon_class" => \Icon::SUB_MODULE,
            "links" => $this->getCommonCrud()
        ];
        
        $this->controller = "Pincodes";
        $submenu['links'][] = [
            "title" => "Pincode",
            "icon_class" => \Icon::SUB_MODULE,
            "links" => $this->getCommonCrud()
        ];
        
        return $submenu;
    }
}

class MemberManagement extends MenuItem
{
    public function get()
    {
        $submenu =  [
            "title" => "Member Manager",
            "icon_class" => \Icon::MODULE,
            "links" => []
        ];
        
        $submenu['links'][] = $this->User();
        
        return $submenu;
    }
    
    private function User()
    {
        $this->controller = "Users";
        $submenu = [
            "title" => "User",
            "icon_class" => \Icon::SUB_MODULE,
            "links" => $this->getCommonCrud()
        ];
        
        return $submenu;
    }
}

class LogManager extends MenuItem
{
    public function get()
    {
        $this->controller = "Logs";
        
        $submenu =  [
            "title" => "Logs",
            "icon_class" => \Icon::MODULE,
            "links" => []
        ];
        
        $submenu['links'][] = $this->menuItem("File Import Logs", "import_logs");
        $submenu['links'][] = $this->menuItem("Email Logs", "email_logs");
        $submenu['links'][] = $this->menuItem("Notifications", "notifications");
        $submenu['links'][] = $this->menuItem("Push Notifications", "push_notification_logs");
        
        $submenu['links'][] = $this->Developer();
        
        return $submenu;
    }
    
    private function Developer()
    {
        $submenu =  [
            "title" => "Developer Logs",
            "icon_class" => \Icon::SUB_MODULE,
            "links" => []
        ];
        
        $submenu['links'][] = $this->menuItem("Web Service Logs", "web_services");
        $submenu['links'][] = $this->menuItem("Cron Job Logs", "crons");
        $submenu['links'][] = $this->menuItem("SQL Logs", "sql_logs");
        $submenu['links'][] = $this->menuItem("Auto Increment Logs", "autoIncrements");
        $submenu['links'][] = $this->menuItem("Unicommerce Api Logs", "unicommerce_api_logs");
        $submenu['links'][] = $this->menuItem("Virtual Inventory Logs", "vertual_inventory_logs");
		
        return $submenu;
    }
}