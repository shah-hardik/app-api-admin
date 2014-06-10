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
class Neighborhood {
    # constructor

    public static function neighborhoodList($id) {
        if (empty($id)) {
//            $condition = "where 1=1 ";
        } else {
            $condition = "where id='{$id}'";
        }
        return q("SELECT * FROM neighborhood {$condition}");
    }

    public static function addNeighborhood($fields) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['name'] = 'name';
        $map['location'] = 'location';
        $map['latitude'] = 'location_latitude';
        $map['longitude'] = 'location_longitude';

        $ds = _bindArray($data, $map);
        return qi('neighborhood', $ds);
    }
 
    public static function editNeighborhood($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['name'] = 'name';
        $map['location'] = 'location';
        $map['latitude'] = 'location_latitude';
        $map['longitude'] = 'location_longitude';

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qu('neighborhood', $ds, $condition);
    }

    public static function deleteNeighborhood($id) {
        $condition = "id =" . $id;
        return qd('neighborhood', $condition);
    }

}

?>