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
//$addLabel = "Add Alerts";
//
//$alert = "";
//$type = "";


if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

    $data = Alerts::addAlerts($_REQUEST[fields]);
    if ($data != '') {
        $greetings = "Alerts inserted successfully";
    } else {
        $error = "Unable to add Alerts";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

    $data = Alerts::editAlerts($_REQUEST[fields], $_REQUEST['fields']['users_id']);
    if ($data != '') {
        $greetings = "Alerts updated successfully";
    } else {
        $error = "Unable to Update Alerts";
    }
}

switch ($urlArgs[0]) {
    case "edit":
        $subTpl = "alerts_add.php";
        $addIcon = "edit";
        $addLabel = "Edit Alerts";
        $activeMenuAdd = "active";
        if ($urlArgs[1] > 0) {
            $view_data = Alerts::alertList($urlArgs[1]);
            $alert = $view_data[0]['alert'];
            $type = $view_data[0]['type'];

            $id_val = $urlArgs[1];
        }
        break;
//    case "add":
//        $subTpl = "alerts_add.php";
//        $activeMenuAdd = "active";
//        break;

    case "delete":
        $delete_data = Alerts::deleteAlerts($urlArgs[1]);

        if ($delete_data) {
            $greetings = "Alerts deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Alerts";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('alerts/list'));

        break;
    default:
        $subTpl = "alerts_list.php";
        $activeMenuList = "active";
}

//Grid Delete
if (isset($_REQUEST['delete'])) {


    $CheckBoxId = $_REQUEST['delete'];
    $ids = implode(",", $CheckBoxId);


    $condition = "id IN (" . $ids . ")";
    $delete_data = qd('user_alert', $condition);
    unset($_REQUEST['delete']);

   if ($delete_data) {
            $greetings = "Alerts deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Alerts";
            $_SESSION['error_msg'] = $error;
        }
    _R(lr('alerts/list'));
}

$alerts = Alerts::alertList();

$jsInclude = "alerts.js.php";
_cg("page_title", "Alerts");
?>
