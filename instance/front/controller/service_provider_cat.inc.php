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
$urlArgs = _cg("url_vars");
$addIcon = "plus";
$addLabel = "Add Service Provider Category";

$name = "";
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

    $data = qi('service_provider_category', Array("name" => $_REQUEST['fields']['name']));
    if ($data != '') {
        $greetings = "Service Provider Category inserted successfully";
    } else {
        $error = "Unable to add Service Provider Category";
    }
}
switch ($urlArgs[0]) {
    case "add":
        $subTpl = "service_provider_cat_add.php";
        $activeMenuAdd = "active";
        break;
    case "delete":
        $condition = "id =" . $urlArgs[1];
        $delete_data = qd('service_provider_category', $condition);

        if ($delete_data) {
            $greetings = "Service Provider Category deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Service Provider Category";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('service_provider_cat/list'));

        break;
    default:
        $subTpl = "service_provider_cat_list.php";
        $activeMenuList = "active";
}

$service_provider_category = q("SELECT * FROM  service_provider_category");
;

$jsInclude = "service_provider_cat.js.php";
_cg("page_title", "Service Provider Category");
?>
