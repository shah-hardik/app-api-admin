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
$addLabel = "Add Neighborhood";

if (isset($_REQUEST['fields']) && $_REQUEST['fields']['neighborhood_id'] == '') {

    $data = Neighborhood::addNeighborhood($_REQUEST[fields]);

    if ($data != '') {
        $neighborhood_id = qs("select * from neighborhood  ORDER BY id DESC limit 0,1");
        qi('neighborhood_has_user', Array("neighborhood_id" => $neighborhood_id['id'], 'user_id' => $_REQUEST['fields']['user']));

        $greetings = "Neighborhood inserted successfully";
    } else {
        $error = "Unable to Add Neighborhood";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['neighborhood_id'] > 0) {

    $data = Neighborhood::editNeighborhood($_REQUEST[fields], $_REQUEST['fields']['neighborhood_id']);
    if ($data != '') {
        qu('neighborhood_has_user', Array("user_id" => $_REQUEST['fields']['user']), "neighborhood_id= '{$_REQUEST['fields']['neighborhood_id']}'");
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
            $locations = $view_data[0]['location'];
            $latitude = $view_data[0]['location_latitude'];
            $longitude = $view_data[0]['location_longitude'];
            $id_val = $urlArgs[1];

            $user = qs("select * from neighborhood_has_user where neighborhood_id= $urlArgs[1]");
            $user_ = $user['user_id'];
        }
        break;
    case "add":
        $subTpl = "neighborhood_add.php";
        $activeMenuAdd = "active";
        break;
    case "delete":
        $condition = "neighborhood_id =" . $urlArgs[1];
        qd('neighborhood_has_user', $condition);
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
