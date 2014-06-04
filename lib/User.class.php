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
class User {
    # constructor

    public static $user_data = array();

    public function __construct() {
        
    }

    /**
     *
     * @param array $fields
     * @param integer $id
     * @return boolean 
     */
    public static function update($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['admin_email'] = 'user_name';

        if ($fields['admin_password'] != '') {
            $data['admin_password'] = md5($data['admin_password']);
            $map['admin_password'] = 'password';
        }

        $ds = _bindArray($data, $map);
        $condition = " id = " . $id;
        return qu('admin_users', $ds, $condition);
    }

    /**
     *
     * @param array $fields
     * @param integer $id
     * @return boolean 
     */
    public static function updatePassword($password, $email) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $data['admin_password'] = md5($password);
        $map['admin_password'] = 'password';
        $ds = _bindArray($data, $map);
        $condition = " user_name = '" . $email . "'";
        return qu('admin_users', $ds, $condition);
    }

    /**
     * Checks the login
     * @param String $user_name
     * @param String $password
     * @return boolean
     */
    public static function doLogin($user_name, $password) {
        self::$user_data = qs(sprintf("select * from admin_users where user_name = '%s' and password = '%s'", $user_name, md5($password)));
        if (!empty(self::$user_data)) {

            self::$user_data['user_type'] = 'admin';
        }

        return empty(self::$user_data) ? false : true;
    }

    /**
     * Checks the email
     * @param String $user_name
     * @return boolean
     */
    public static function ForgotPassword($user_name) {
        return qs(sprintf("select * from admin_users where user_name = '%s'", $user_name));
    }

    /**
     *
     * @param String $user_name
     */
    public static function setSession($user_name) {
        // d(self::$user_data);
        $_SESSION['user'] = self::$user_data;
    }

    /**
     *  Kill the session
     */
    public static function killSession() {
        session_destroy();
        unset($_SESSION);
    }

    function generate_password($length = 12, $special_chars = true) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ($special_chars)
            $chars .= '!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++)
            $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        return $password;
    }

    public static function initUserSession($user_name) {
        self::$user_data = qs("select * from admin_users where user_name = '{$user_name}'");
        self::$user_data['user_type'] = 'admin';
        User::setSession($user_name);
        session_regenerate_id();
        $user_activity['session_id'] = session_id();
        $user_activity['user_id'] = $_SESSION['user']['id'];
        $user_activity['user_type'] = $_SESSION['user']['user_type'];
        User_activity::add($user_activity);
    }

    public static function getCurrentUserName() {
        $userName = $_SESSION['user']['user_name'];
        if ($_SESSION['user']['user_name'] == "admin@admin.com") {
            $userName = "Master Admin";
        }
        if ($_SESSION['user']['user_type'] == 'dispatchers') {
            $userName = "Dispatcher " . $_SESSION['user']['name'];
        }
        return $userName;
    }

    public static function UsersList($id) {
        if (empty($id)) {
            $condition = "where 1=1 ";
        } else {
            $condition = "where id='{$id}'";
        }
        return q("SELECT * FROM user {$condition}");
    }

    public static function addUser($fields) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['user_fname'] = 'first_name';
        $map['user_lname'] = 'last_name';
        $map['email'] = 'email';
        $map['password'] = 'password';
        $map['phone'] = 'phone_no';
        $map['address'] = 'address';
        $map['city'] = 'city';
        $map['state'] = 'state';
        $map['zipcode'] = 'zipcode';
        $map['user_name'] = 'username';

        $ds = _bindArray($data, $map);
        return qi('user', $ds);
    }

    public static function editUser($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['user_fname'] = 'first_name';
        $map['user_lname'] = 'last_name';
        $map['email'] = 'email';
        $map['password'] = 'password';
        $map['phone'] = 'phone_no';
        $map['address'] = 'address';
        $map['city'] = 'city';
        $map['state'] = 'state';
        $map['zipcode'] = 'zipcode';
        $map['user_name'] = 'username';

        $ds = _bindArray($data, $map);
        $condition = "id = " . $id;
        return qu('user', $ds, $condition);
    }

    public static function deleteUser($id) {
        $condition = "id =" . $id;
        return qd('user', $condition);
    }

    public static function GetProfilePicture($userId) {
        $res = qs("SELECT * FROM user_profile_picture WHERE user_id = " . $userId);
        if (!empty($res)) {
            $img_path = _U . 'api/user_img/' . $res['picture'];
            $img_path = str_replace('app-api-admin', 'app_api', $img_path);
            $img_path = str_replace('api-admin', 'api', $img_path);
        } else {
            $img_path = '';
        }
        return $img_path;
    }

}
?>