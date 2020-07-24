<?php

class GroupType
{
    const ADMIN = 1;
}

class EmailType
{
    
}

class NotificationType
{
    const NOTI_FROM_SYSTEM = 1;
    const NOTI_FROM_USER = 2;
    
    public static $list = [
        self::NOTI_FROM_SYSTEM => "System",
        self::NOTI_FROM_USER => "User",
    ];
}
