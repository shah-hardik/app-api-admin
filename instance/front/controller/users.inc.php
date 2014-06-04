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



if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

    //For Uploadin Profilr Picture
    $filename = $_FILES['image']['tmp_name'];
    $db_filename = mt_rand(0, 999999) . $_FILES['image']['name'];
    $destination = _PATH . 'api/user_img/' . $db_filename;
    $destination = str_replace('app-api-admin', 'app_api', $destination);
    $destination = str_replace('api-admin', 'api', $destination);
    $image = move_uploaded_file($filename, $destination);

    //Inserting Row
    $data_picture = qi('user_profile_picture', Array("picture" => $db_filename));
    $data_user = User::addUser($_REQUEST[fields]);


    if ($data_user != '' && $data_picture != '') {
        $greetings = "Users inserted successfully";
    } else {
        $error = "Unable to add Users";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

//For Uploadin Profilr Picture

    $filename = $_FILES['image']['tmp_name'];
    if (empty($filename)) {
        $db_filename = $_REQUEST['fields']['image_name'];
    } else {
        $db_filename = mt_rand(0, 999999) . $_FILES['image']['name'];
        $destination = _PATH . 'api/user_img/' . $db_filename;
        $destination = str_replace('app-api-admin', 'app_api', $destination);
        $destination = str_replace('api-admin', 'api', $destination);
        $image = move_uploaded_file($filename, $destination);
    }
    //updating Row
    $data_picture = qu('user_profile_picture', Array("picture" => $db_filename), "user_id=" . $_REQUEST['fields']['users_id']);

    $data = User::editUser($_REQUEST[fields], $_REQUEST['fields']['users_id']);
    if ($data != '' && $data_picture != '') {
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

            $image_path = User::GetProfilePicture($urlArgs[1]);
            $image_name = qs("SELECT * FROM user_profile_picture WHERE user_id = " . $urlArgs[1]);
            $image = $image_name['picture'];
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
