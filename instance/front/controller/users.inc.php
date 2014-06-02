<?php

/**
 * User List File
 * 
 * 
 * @author Hardik Shah <hardiks059@gmail.com>
 * @version 1.0
 * @package app-api-admin
 * 
 */
$subTpl = "users_list.php";
switch ($urlArgs[0]) {
    case "add":
        break;
    default:
        $subTpl = "users_list.php";
        $activeMenuList = "active";
}

$users = User::UsersList();

$jsInclude = "users.js.php";
_cg("page_title", "Users");
?>
