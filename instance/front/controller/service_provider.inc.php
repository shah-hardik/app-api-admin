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
$addLabel = "Add Service Provider";

$name = "";
$latitude = "";
$longitude = "";


if (isset($_REQUEST['fields']) && $_REQUEST['fields']['service_id'] == '') {

    $data = Service::addServiceProvider($_REQUEST[fields]);
    if ($data != '') {
        $service_provider_id = qs("select * from service_provider  ORDER BY id DESC limit 0,1");
        qi('service_provider_has_service_provider_category', Array("service_provider_id" => $service_provider_id['id'], 'service_provider_category_id' => $_REQUEST['fields']['service_category']));

        $greetings = "Service Provider inserted successfully";
    } else {
        $error = "Unable to add Service Provider";
    }
}
if (isset($_REQUEST['fields']) && $_REQUEST['fields']['service_id'] > 0) {

    $data = Service::editServiceProvider($_REQUEST[fields], $_REQUEST['fields']['service_id']);
    if ($data != '') {
        qu('service_provider_has_service_provider_category', Array("service_provider_category_id" => $_REQUEST['fields']['service_category']), "service_provider_id= '{$_REQUEST['fields']['service_id']}'");

        $greetings = "Service Provider updated successfully";
    } else {
        $error = "Unable to Update Service Provider";
    }
}

switch ($urlArgs[0]) {
    case "edit":
        $subTpl = "service_provider_add.php";
        $addIcon = "edit";
        $addLabel = "Edit Service Provider";
        $activeMenuAdd = "active";
        if ($urlArgs[1] > 0) {
            $view_data = Service::ServiceProviderList($urlArgs[1]);
            $name = $view_data[0]['name'];
            $latitude = $view_data[0]['location_latitude'];
            $longitude = $view_data[0]['location_longitude'];
            $id_val = $urlArgs[1];

            $service_provider_category = qs("select * from service_provider_has_service_provider_category where service_provider_id= $urlArgs[1]");
            $service_provider_category_id = $service_provider_category['service_provider_category_id'];
        }
        break;
    case "add":
        $subTpl = "service_provider_add.php";
        $activeMenuAdd = "active";
        break;
    case "delete":
        $condition = "service_provider_id =" . $urlArgs[1];
        qd('service_provider_has_service_provider_category', $condition);
        
        $delete_data = Service::deleteServiceProvider($urlArgs[1]);

        if ($delete_data) {
            $greetings = "Service Provider deleted successfully";
            $_SESSION['greetings_msg'] = $greetings;
        } else {
            $error = "Unable to delete Service Provider";
            $_SESSION['error_msg'] = $error;
        }
        _R(lr('service_provider/list'));

        break;
    default:
        $subTpl = "service_provider_list.php";
        $activeMenuList = "active";
}

$service_provider = Service::ServiceProviderList();

$jsInclude = "service_provider.js.php";
_cg("page_title", "Service Provider");
?>
