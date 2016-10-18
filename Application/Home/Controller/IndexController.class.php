<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index()
    {

        $this->display();
//        $this->success();
    }

    public function jiekou(){
        $arr = array(
            'name' => "sunyangzhao",
            'age' => '95',
            'sex' => 'male',
        );
        $jarr = json_encode($arr);
        echo $jarr;
        exit;

    }


}