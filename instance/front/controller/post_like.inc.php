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
        $condition = "post_id =" . $urlArgs[0];

        $delete_data = qd('post_like', $condition);

        if ($delete_data) {
            $greetings = "Post Like deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Post Like";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('post_like/list'));

        break;
    default:
        $subTpl = "post_like_list.php";
        $activeMenuList = "active";
}


//Grid Delete
if (isset($_REQUEST['delete'])) {


    $CheckBoxId = $_REQUEST['delete'];
    $ids = implode(",", $CheckBoxId);


    $condition = "post_id IN (" . $ids . ")";
    $delete_data = qd('post_like', $condition);
    unset($_REQUEST['delete']);


    if ($delete_data) {
        $greetings = "Post Like deleted successfully";
        $_SESSION['greetings_msg'] = $greetings;
    } else {
        $error = "Unable to delete Post Like";
        $_SESSION['error_msg'] = $error;
    }
    _R(lr('post_like/list'));
}

$post_like = q("SELECT * FROM post_like ");

$jsInclude = "post_like.js.php";
_cg("page_title", "Post Like");
?>
