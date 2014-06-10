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


//Insert
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

    //For Uploadin Profilr Picture
    $filename = $_FILES['image']['tmp_name'];
    $db_filename = mt_rand(0, 999999) . $_FILES['image']['name'];
    $destination = _PATH . 'user_img/' . $db_filename;
    $destination = str_replace('app-api-admin', 'app_api', $destination);
    $destination = str_replace('api-admin', 'api', $destination);
    $image = move_uploaded_file($filename, $destination);
    $user_ = User::UsersList();
    foreach ($user_ as $each_user):

        if (strtolower($each_user['username']) == strtolower($_REQUEST['fields']['user_name'])) {
            $username_exits = 1;
        }
        if (strtolower($each_user['email']) == strtolower($_REQUEST['fields']['email'])) {
            $email_exits = 1;
        }
    endforeach;

    if (empty($username_exits) && empty($email_exits)) {
        //Inserting Row

        $data_user = User::addUser($_REQUEST[fields]);

        $data_picture = qi('user_profile_picture', Array("email" => $_REQUEST['fields']['email'],
            "picture" => $db_filename));


        if ($data_user != '' && $data_picture != '') {
            $user_id = qs("select * from user  ORDER BY id DESC limit 0,1");
            qi('user_has_service_provider', Array("user_id" => $user_id['id'], 'service_provider_id' => $_REQUEST['fields']['service_provider']));

            $greetings = "Users inserted successfully";
        } else {
            $error = "Unable to add Users";
        }
    } else {
        if (!empty($username_exits)) {
            $error = "Someone already has that username. Try another!! ";
        } else if (!empty($email_exits)) {
            $error = "Someone already has that Email. Try another!! ";
        }
    }
}

//Update
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

//For Uploadin Profilr Picture

    $filename = $_FILES['image']['tmp_name'];
    if (empty($filename)) {
        $db_filename = $_REQUEST['fields']['image_name'];
    } else {
        $db_filename = mt_rand(0, 999999) . $_FILES['image']['name'];
        $destination = _PATH . 'user_img/' . $db_filename;
        $destination = str_replace('app-api-admin', 'app_api', $destination);
        $destination = str_replace('api-admin', 'api', $destination);
        $image = move_uploaded_file($filename, $destination);
    }

    $user_ = User::UsersList();
    foreach ($user_ as $each_user):

        if ($each_user['id'] != $_REQUEST['fields']['users_id']) {
            if (strtolower($each_user['username']) == strtolower($_REQUEST['fields']['user_name'])) {
                $username_exits = 1;
            }
            if (strtolower($each_user['email']) == strtolower($_REQUEST['fields']['email'])) {
                $email_exits = 1;
            }
        }
    endforeach;

    if (empty($username_exits) && empty($email_exits)) {
        //updating Row

        $data = User::editUser($_REQUEST[fields], $_REQUEST['fields']['users_id']);
        $data_picture = qu('user_profile_picture', Array("picture" => $db_filename), "email= '{$_REQUEST['fields']['email']}' ");
        if ($data != '' && $data_picture != '') {
            qu('user_has_service_provider', Array("service_provider_id" => $_REQUEST['fields']['service_provider']), "user_id= '{$_REQUEST['fields']['users_id']}'");

            $greetings = "Users updated successfully";
        } else {
            $error = "Unable to Update Users";
        }
    } else {
        if (!empty($username_exits)) {
            $error = "Someone already has that username. Try another!! ";
        } else if (!empty($email_exits)) {
            $error = "Someone already has that Email. Try another!! ";
        }
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

            $image_path = User::GetProfilePicture($view_data[0]['email']);
            $image_name = qs("SELECT * FROM user_profile_picture WHERE email ='{$view_data[0]['email']}'");
            $image_ = $image_name['picture'];

            $service_provider = qs("select * from  user_has_service_provider where user_id= $urlArgs[1]");
            $service_provider_id = $service_provider['service_provider_id'];
        }
        break;
    case "add":
        $subTpl = "users_add.php";
        $activeMenuAdd = "active";
        break;
    case "delete":
        $condition = "user_id =" . $urlArgs[1];
        qd('user_has_service_provider', $condition);

        $email = qs("SELECT * FROM user where id=" . $urlArgs[1]);
        $condition_profile = "email = '{$email['email']}'";
        qd('user_profile_picture', $condition_profile);

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
