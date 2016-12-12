<?php
/**
 * Created by PhpStorm.
 * User: hardy
 * Date: 16-12-12
 * Time: 下午5:38
 */

function userIsLogin(){
    if(!session('lms_user')){
        redirect('/Home/User/index');
    }
}
