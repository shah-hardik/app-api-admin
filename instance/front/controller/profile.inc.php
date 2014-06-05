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
$addLabel = "Add Profile";

$about = "";
$address_val = "";
$city_val = "";
$state_val = "";
$zipcode_val = "";
$location_longitude = "";
$location_latitude = "";


if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

    $data_user = Profile::addProfile($_REQUEST[fields]);


    if ($data_user != '' && $data_picture != '') {
        $greetings = "Profile inserted successfully";
    } else {
        $error = "Unable to add Profile";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

    $data = Profile::editProfile($_REQUEST[fields], $_REQUEST['fields']['users_id']);

    if ($data != '' && $data_picture != '') {
        $greetings = "Profile updated successfully";
    } else {
        $error = "Unable to Update Profile";
    }
}

switch ($urlArgs[0]) {
    case "edit":
        $subTpl = "profile_add.php";
        $addIcon = "edit";
        $addLabel = "Edit Profile";
        $activeMenuAdd = "active";
        if ($urlArgs[1] > 0) {
            $view_data = Profile::ProfileList($urlArgs[1]);

            $about = $view_data[0]['about'];
            $address_val = $view_data[0]['address'];
            $city_val = $view_data[0]['city'];
            $state_val = $view_data[0]['state'];
            $zipcode_val = $view_data[0]['zip'];
            $location_longitude = $view_data[0]['location_longitude'];
            $location_latitude = $view_data[0]['location_latitude'];
            $id_val = $urlArgs[1];
        }
        break;
    case "add":
        $subTpl = "profile_add.php";
        $activeMenuAdd = "active";
        break;
    case "delete":
        $delete_data = Profile::deleteProfile($urlArgs[1]);

        if ($delete_data) {
            $greetings = "Profile deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Profile";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('profile/list'));

        break;
    default:
        $subTpl = "profile_list.php";
        $activeMenuList = "active";
}

$profile = Profile::ProfileList();

$jsInclude = "profile.js.php";
_cg("page_title", "Profile");
?>
