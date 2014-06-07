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

$post_like =q("SELECT * FROM post_like ");

$jsInclude = "post_like.js.php";
_cg("page_title", "Post Like");
?>
