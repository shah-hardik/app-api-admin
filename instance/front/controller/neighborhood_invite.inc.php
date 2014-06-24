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
        $condition = "id =" . $urlArgs[1];
        $delete_data = qd('neighborhood_invite', $condition);

        if ($delete_data) {
            $greetings = "Neighborhood Invite deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Neighborhood Invite";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('neighborhood_invite/list'));

        break;
    default:
        $subTpl = "neighborhood_invite_list.php";
        $activeMenuList = "active";
}

//Grid Delete
if (isset($_REQUEST['delete'])) {


    $CheckBoxId = $_REQUEST['delete'];
    $ids = implode(",", $CheckBoxId);


    $condition = "id IN (" . $ids . ")";
    $delete_data = qd('neighborhood_invite', $condition);
    unset($_REQUEST['delete']);
    
     if ($delete_data) {
            $greetings = "Neighborhood Invite deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Neighborhood Invite";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('neighborhood_invite/list'));
}
$neighborhood = q("SELECT * FROM  neighborhood_invite");
;

$jsInclude = "neighborhood_invite.js.php";
_cg("page_title", "Neighborhood Invite");
?>
