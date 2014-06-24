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

switch ($urlArgs[0]) {

    case "delete":
        $condition = "id =" .$urlArgs[0];

        $delete_data = qd('post_comment', $condition);

        if ($delete_data) {
            $greetings = "Post Comment deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Post Comment";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('post_comment/list'));

        break;
    default:
        $subTpl = "post_comment_list.php";
        $activeMenuList = "active";
}


//Grid Delete
if (isset($_REQUEST['delete'])) {


    $CheckBoxId = $_REQUEST['delete'];
    $ids = implode(",", $CheckBoxId);


    $condition = "id IN (" . $ids . ")";
    $delete_data = qd('post_comment', $condition);
    unset($_REQUEST['delete']);
    
     if ($delete_data) {
            $greetings = "Post Comment deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Post Comment";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('post_comment/list'));
}

$post_comment =q("SELECT * FROM post_comment ");

$jsInclude = "post_comment.js.php";
_cg("page_title", "Post Comment");
?>
