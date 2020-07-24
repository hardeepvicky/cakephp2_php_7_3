<?php
class Menu
{
    public static $default = array(
        array(
            "title" => "Home",
            "icon_class" => "icon-layers",
            "links" => [
                "default" => [
                    "title" => "Dashboard",
                    "icon_class" => "fa fa-reorder",
                    "link" => [
                        "controller" => "Dashboards",
                        "action" => "index",
                        "admin" => true
                    ],
                    "other_links" => [],
                ],
                [
                    "title" => "Permissions",
                    "icon_class" => "fa fa-reorder",
                    "link" => [
                        "controller" => "Users",
                        "action" => "permissions",
                        "admin" => true
                    ],
                    "other_links" => [],
                ]
            ]
        ),
        array(
            "title" => "User Manager",
            "icon_class" => "icon-layers",
            "links" => [
                [
                    "title" => "Summary",
                    "icon_class" => "fa fa-reorder",
                    "link" => [
                        "controller" => "Users",
                        "action" => "index",
                        "admin" => true
                    ],
                    "other_links" => [],
                ],
                [
                    "title" => "Add",
                    "icon_class" => "fa fa-plus-circle",
                    "link" => [
                        "controller" => "Users",
                        "action" => "add",
                        "admin" => true
                    ],
                    "other_links" => [
                        [
                            "title" => "Edit",
                            "controller" => "Users",
                            "action" => "edit"
                        ],
                    ],
                ],
            ]
        ),
    );

    public static function get($main_menu, $acl, $group_id)
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

                //if ($acl->check(array("model" => "Group", "foreign_key" => $group_id), $url))
                {
                    $menus[$k] = $submenu;
                }
            }
            else if (isset($submenu['links']))
            {
                $menus[$k] = $submenu;
                $menus[$k]['links'] = self::get($submenu['links'], $acl, $group_id);
                if (empty($menus[$k]['links']))
                {
                    unset($menus[$k]);
                }
            }
        }

        return $menus;
    }

    public static function getDefaultLink($menus)
    {
        foreach ($menus as $menu)
        {
            foreach ($menu["links"] as $key => $submenu)
            {
                if (strtolower($key) == "default")
                {
                    return $submenu["link"];
                }
            }
        }
    }

    public static function getBreadcum($menus, $controller, $action)
    {
        $breadcum = array();
        $controller = Inflector::camelize($controller);
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
