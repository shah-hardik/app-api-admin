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


if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

    $data = Neighborhood::editNeighborhood($_REQUEST[fields], $_REQUEST['fields']['users_id']);
    if ($data != '') {
        $greetings = "Neighborhood updated successfully";
    } else {
        $error = "Unable to Update Neighborhood";
    }
}

switch ($urlArgs[0]) {
    case "edit":
        $subTpl = "neighborhood_add.php";
        $addIcon = "edit";
        $addLabel = "Edit Neighborhood";
        $activeMenuAdd = "active";
        if ($urlArgs[1] > 0) {
            $view_data = Neighborhood::neighborhoodList($urlArgs[1]);
            $name = $view_data[0]['name'];
            $locations=$view_data[0]['location'];
            $latitude = $view_data[0]['location_latitude'];
            $longitude = $view_data[0]['location_longitude'];
            $id_val = $urlArgs[1];
        }
        break;
    case "delete":
        $delete_data = Neighborhood::deleteNeighborhood($urlArgs[1]);

        if ($delete_data) {
            $greetings = "Neighborhood deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Neighborhood";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('neighborhood/list'));

        break;
    default:
        $subTpl = "neighborhood_list.php";
        $activeMenuList = "active";
}

$neighborhood = Neighborhood::neighborhoodList();

$jsInclude = "neighborhood.js.php";
_cg("page_title", "Neighborhood");
?>
