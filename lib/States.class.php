<?php

/**
 * Post Class
 * 
 * User's Post 
 * 
 * @author Hardik Shah <hardiks059@gmail.com>
 * @version 1.0
 * @package app-api-admin
 * 
 */
class States {

    //put your code here

    public static function statesList($id) {
        if (empty($id)) {
            $condition = "where 1=1 ";
        } else {
            $condition = "where id='{$id}'";
        }
        return q("SELECT * FROM user_stats {$condition}");
    }

    
    
    public static function addState($fields) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
         $map['posts_count'] = 'posts_count';
        $map['neighborhoods_count'] = 'neighborhoods_count';
        $map['neighbors_count'] = 'neighbors_count';
        $map['lists_count'] = 'lists_count';

        $ds = _bindArray($data, $map);
        return qi('user_stats', $ds);
    }

    public static function editState($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['posts_count'] = 'posts_count';
        $map['neighborhoods_count'] = 'neighborhoods_count';
        $map['neighbors_count'] = 'neighbors_count';
        $map['lists_count'] = 'lists_count';

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qu('user_stats', $ds, $condition);
    }

    public static function deleteState($id) {
        $condition = "id =" . $id;
        return qd('user_stats', $condition);
    }

}
