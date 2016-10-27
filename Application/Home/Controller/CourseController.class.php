<?php
namespace Home\Controller;
use Think\Controller;
class CourseController extends Controller {
    public function index()
    {
        $cdb = D('Course');
//        echo $cdb->test();
        if(IS_POST){
            print_r($_POST);
        }
        $this->display();
    }

}