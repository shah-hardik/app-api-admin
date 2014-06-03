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
class Post {

    //put your code here

    public static function postList($id) {
        if (empty($id)) {
            $condition = "where 1=1 ";
        } else {
            $condition = "where id='{$id}'";
        }
        return q("SELECT * FROM post {$condition}");
    }


    public static function editPost($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();

        $map['post_type'] = 'type';
        $map['text'] = 'text';
        $map['media'] = 'media';
        $map['image'] = 'thumbnail';
        $map['latitude'] = 'location_latitude';
        $map['longitude'] = 'location_longitude';

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qu('post', $ds, $condition);
    }

    public static function deletePost($id) {
        $condition = "id =" . $id;
        return qd('post', $condition);
    }

}
