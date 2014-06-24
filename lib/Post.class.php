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

    public static function deletePost($id) {
        $condition = "id =" . $id;
        return qd('post', $condition);
    }

    public static function deleteSelected($ids) {
        $ids = implode(",", $ids);


        $condition = "id IN (" . $ids . ")";
        return qd('post', $condition);
    }

}
