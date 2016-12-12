<?php
/**
 * Created by PhpStorm.
 * User: hardy
 * Date: 16-12-12
 * Time: 下午4:06
 */

namespace Home\Model;
use Think\Model;

class UserModel extends Model
{
    protected $tablename = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function checkUser($user_number, $pwd){
//        $user_number = strip_tags($user_number);
//        $pwd = strip_tags($pwd);
        $user_info = $this->where("user_number = %s", $user_number)->select();
        $res = array();
        $msg = "";
        $status = 0;
        if(!$user_info){
            $msg = 'account does not find';
        }
        else{
            if($user_info[0]['user_password'] === md5($pwd)){
                $status =   1;
                $msg    =   'login successful';
            }
            else{
                $msg    =   'password does not match';
            }
        }
        return array('status' => $status, 'msg' => $msg);
    }
}