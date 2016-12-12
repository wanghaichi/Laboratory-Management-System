<?php
namespace Home\Controller;
use Think\Controller;
class CourseController extends Controller {

    protected $db;

    public function __construct()
    {
        parent::__construct();
        userIsLogin();
        $this->db = D('Course');
    }


    public function index()
    {
//        echo $cdb->test();
        if(IS_POST){

            $firstWeek  =   I('post.firstWeek');
            $lastWeek   =   I('post.lastWeek');
            $firstDay   =   I('post.firstDay');
            $lastDay    =   I('post.lastDay');
            $oddWeek    =   I('post.oddWeek');
            $evenWeek   =   I('post.evenWeek');
            $firstTime  =   I('post.firstTime');
            $lastTime   =   I('post.lastTime');
            $parity = 0;
            if($oddWeek && $evenWeek){
                $parity = 2;
            }
            else if ($oddWeek){
                $parity = 1;
            }
            $reservationData = array(
                'firstWeek' => $firstWeek,
                'lastWeek'  => $lastWeek,
                'firstDay'  => $firstDay,
                'lastDay'   => $lastDay,
                'parity'    => $parity,
                'firstCourse'=> $firstTime,
                'lastCourse'=> $lastTime,
            );
            $infoData = array(

            );
            $result = $this->db->insert_reservation($reservationData, $infoData);
            if($result){
                echo "1234";
            }
            else{
                echo "fail";
            }
            exit;
        }
        $this->display();
    }

}