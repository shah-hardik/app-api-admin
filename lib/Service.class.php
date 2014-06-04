<?php

/**
 * User Class
 * 
 * User login
 * 
 * @author Hardik Shah <hardiks059@gmail.com>
 * @version 1.0
 * @package app-api-admin
 * 
 */
class Service {
    # constructor

    public static function ServiceProviderList($id) {
        if (empty($id)) {
            $condition = "where 1=1 ";
        } else {
            $condition = "where id='{$id}'";
        }
        return q("SELECT * FROM service_provider {$condition}");
    }

    public static function addServiceProvider($fields) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['name'] = 'name';
        $map['latitude'] = 'location_latitude';
        $map['longitude'] = 'location_longitude';


        $ds = _bindArray($data, $map);
        return qi('service_provider', $ds);
    }

    public static function editServiceProvider($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['name'] = 'name';
        $map['latitude'] = 'location_latitude';
        $map['longitude'] = 'location_longitude';

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qu('service_provider', $ds, $condition);
    }

    public static function deleteServiceProvider($id) {
        $condition = "id =" . $id;
        return qd('service_provider', $condition);
    }

}

?>