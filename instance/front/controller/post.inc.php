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
$addLabel = "Add Posts";

$post_type = "";
$text = "";
$media = "";
$image = "";
$latitude = "";
$longitude = "";

if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] == '') {

        $filename = $_FILES['image']['tmp_name'];

        if ($filename) {
            $db_filename = mt_rand(0, 999999) . $_FILES['image']['name'];
            $destination = _PATH . "instance/front/media/img/" . $db_filename;
            $image = move_uploaded_file($filename, $destination);
            $_REQUEST['image'] = $db_filename;
        }
        $ds = _bindArray($data, $map);
        $data = qi('post', Array("user_id"=>$_REQUEST['fields']['user'],
            "type"=>$_REQUEST['fields']['post_type'],
            "text"=>$_REQUEST['fields']['text'],
            "media"=>$_REQUEST['fields']['media'],
            "thumbnail"=>$_REQUEST['image'],
            "location_latitude"=>$_REQUEST['fields']['latitude'],
            "location_longitude"=>$_REQUEST['fields']['longitude'],
                ));
    
    
    
    if ($data != '') {
        $greetings = "Post inserted successfully";
    } else {
        $error = "Unable to add Post";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['users_id'] > 0) {

    $data = Post::editPost($_REQUEST[fields], $_REQUEST['fields']['users_id']);
    if ($data != '') {
        $greetings = "Post updated successfully";
    } else {
        $error = "Unable to Update Post";
    }
}

switch ($urlArgs[0]) {
    case "edit":
        $subTpl = "post_add.php";
        $addIcon = "edit";
        $addLabel = "Edit Posts";
        $activeMenuAdd = "active";
        if ($urlArgs[1] > 0) {
            $view_data = Post::postList($urlArgs[1]);
            $post_type = $view_data[0]['type'];
            $text = $view_data[0]['text'];
            $media = $view_data[0]['media'];
            $image = $view_data[0]['thumbnail'];
            $latitude = $view_data[0]['location_latitude'];
            $longitude = $view_data[0]['location_longitude'];
            $id_val = $urlArgs[1];
        }
        break;
    case "add":
        $subTpl = "post_add.php";
        $activeMenuAdd = "active";
        break;
    case "delete":
        $delete_data = Post::deletePost($urlArgs[1]);

        if ($delete_data) {
            $greetings = "Post deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Post";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('post/list'));

        break;
    default:
        $subTpl = "post_list.php";
        $activeMenuList = "active";
}

$users = Post::postList();

$jsInclude = "post.js.php";
_cg("page_title", "Post");
?>