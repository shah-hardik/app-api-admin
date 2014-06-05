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
class Alerts {
    # constructor

    public static function alertList($id) {
        if (empty($id)) {
            $condition = "where 1=1 ";
        } else {
            $condition = "where id='{$id}'";
        }
        return q("SELECT * FROM user_alert {$condition}");
    }

    
        public static function addAlerts($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['type'] = 'type';
        $map['alert'] = 'alert';
      

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qi('user_alert', $ds);
    }
    public static function editAlerts($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['type'] = 'type';
        $map['alert'] = 'alert';
      

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qu('user_alert', $ds, $condition);
    }

    public static function deleteAlerts($id) {
        $condition = "id =" . $id;
        return qd('user_alert', $condition);
    }

}

?>