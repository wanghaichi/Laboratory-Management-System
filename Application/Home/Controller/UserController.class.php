<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->display('login');
    }

    public function login(){
        $user_number    =   I('post.user_number');
        $pwd            =   I('post.user_password');
        if(!$user_number || !$pwd){
            echo json_encode(array('status' => 0, 'msg' => "信息填写不完整"));
            exit;
        }
        $user = D('User');
        $res = $user->checkUser($user_number, $pwd);
        if($res['status'] == 1){
            $this->touchSession($user_number);
        }
        echo json_encode($res);
    }

    public function logout(){

    }

    private function touchSession($user){
        session('lms_user', $user);
    }
}