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
//$addIcon = "plus";
//$addLabel = "Add States";
//
//$posts_count = "";
//$neighborhoods_count = "";
//$neighbors_count = "";
//$lists_count = "";


if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

    $data = States::addState($_REQUEST[fields]);
    if ($data != '') {
        $greetings = "States inserted successfully";
    } else {
        $error = "Unable to add States";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

    $data = States::editState($_REQUEST[fields], $_REQUEST['fields']['users_id']);
    if ($data != '') {
        $greetings = "States updated successfully";
    } else {
        $error = "Unable to Update States";
    }
}

switch ($urlArgs[0]) {
    case "edit":
        $subTpl = "states_add.php";
        $addIcon = "edit";
        $addLabel = "Edit States";
        $activeMenuAdd = "active";
        if ($urlArgs[1] > 0) {
            $view_data = States::statesList($urlArgs[1]);
            $posts_count = $view_data[0]['posts_count'];
            $neighborhoods_count = $view_data[0]['neighborhoods_count'];
            $neighbors_count = $view_data[0]['neighbors_count'];
            $lists_count = $view_data[0]['lists_count'];
            $id_val = $urlArgs[1];
        }
        break;
//    case "add":
//        $subTpl = "states_add.php";
//        $activeMenuAdd = "active";
        break;
    case "delete":
        $delete_data = States::deleteState($urlArgs[1]);

        if ($delete_data) {
            $greetings = "States deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete States";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('states/list'));

        break;
    default:
        $subTpl = "states_list.php";
        $activeMenuList = "active";
}

if (isset($_REQUEST['delete'])) {


    $delete_data = States::deleteSelected($_REQUEST['delete']);

    unset($_REQUEST['delete']);
    if ($delete_data) {
        $greetings = "States deleted successfully";
        $_SESSION['greetings_msg'] = $greetings;
    } else {
        $error = "Unable to delete States";
        $_SESSION['error_msg'] = $error;
    }
    _R(lr('states/list'));
}
$state = States::statesList();

$jsInclude = "states.js.php";
_cg("page_title", "States");
?>
