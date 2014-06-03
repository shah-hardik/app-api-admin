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
$addLabel = "Add Users";

$user_fname = "";
$user_lname = "";
$user_name = "";
$email = "";
$phone_val = "";
$address_val = "";
$city_val = "";
$state_val = "";
$zipcode_val = "";

$zipcode_val = $view_data['zipcode'];
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

    $data = User::addUser($_REQUEST[fields]);
    if ($data != '') {
        $greetings = "Users inserted successfully";
    } else {
        $error = "Unable to add Users";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

    $data = User::editUser($_REQUEST[fields], $_REQUEST['fields']['users_id']);
    if ($data != '') {
        $greetings = "Users updated successfully";
    } else {
        $error = "Unable to Update Users";
    }
}

switch ($urlArgs[0]) {
    case "edit":
        $subTpl = "users_add.php";
        $addIcon = "edit";
        $addLabel = "Edit Users";
        $activeMenuAdd = "active";
        if ($urlArgs[1] > 0) {
            $view_data = User::UsersList($urlArgs[1]);
            $user_fname = $view_data[0]['first_name'];
            $user_lname = $view_data[0]['last_name'];
            $user_name = $view_data[0]['username'];
            $email = $view_data[0]['email'];
            $phone_val = $view_data[0]['phone_no'];
            $address_val = $view_data[0]['address'];
            $city_val = $view_data[0]['city'];
            $state_val = $view_data[0]['state'];
            $zipcode_val = $view_data[0]['zipcode'];
            $id_val = $urlArgs[1];
        }
        break;
    case "add":
        $subTpl = "users_add.php";
        $activeMenuAdd = "active";
        break;
    case "delete":
        $delete_data = User::deleteUser($urlArgs[1]);

        if ($delete_data) {
            $greetings = "User deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete User";
            $_SESSION['error_msg'] = $error;
        }
       _R(lr('users/list'));

        break;
    default:
        $subTpl = "users_list.php";
        $activeMenuList = "active";
}

$users = User::UsersList();

$jsInclude = "users.js.php";
_cg("page_title", "Users");
?>
