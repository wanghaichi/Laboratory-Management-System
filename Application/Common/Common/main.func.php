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
function randColor(){
    $colors = array();
    for($i = 0; $i < 6; $i ++){
        $colors[] = dechex(rand(0,15));
    }
    return '#'.implode('',$colors);
}