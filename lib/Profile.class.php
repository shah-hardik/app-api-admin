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
class Profile {
    # constructor

    public static function ProfileList($id) {
        if (empty($id)) {
            $condition = "where 1=1 ";
        } else {
            $condition = "where id='{$id}'";
        }
        return q("SELECT * FROM  user_profile {$condition}");
    }

    public static function addProfile($fields) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['about'] = 'about';
        $map['address'] = 'address';
        $map['city'] = 'city';
        $map['state'] = 'state';
        $map['zip'] = 'zip';
        $map['latitude'] = 'location_latitude';
        $map['longitude'] = 'location_longitude';

        $ds = _bindArray($data, $map);
        return qi('user_profile', $ds);
    }

    public static function editProfile($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
         $map['about'] = 'about';
        $map['address'] = 'address';
        $map['city'] = 'city';
        $map['state'] = 'state';
        $map['zip'] = 'zip';
        $map['location_latitude'] = 'location_latitude';
        $map['location_longitude'] = 'location_longitude';

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qu('user_profile', $ds, $condition);
    }

    public static function deleteProfile($id) {
        $condition = "id =" . $id;
        return qd('user_profile', $condition);
    }

}

?>
