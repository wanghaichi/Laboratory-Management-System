<?php
namespace Home\Controller;
use Think\Controller;
class CourseController extends Controller {

    protected $db;

    public function __construct()
    {
        parent::__construct();
//        userIsLogin();
        $this->db = D('ReservationList');
    }

    public function test(){
        echo randColor();
//        echo $this->db->get_now_week();
    }

    public function index()
    {
        //当前显示第几周
        $week = I('get.week', 1);
        $courseMap = array();
        //查询当前周的排课信息
        $nowCourse = $this->db
            ->alias('a')
            ->field('a.num_day, a.num_course, a.info_id, c.name')
            ->join('LEFT JOIN lms_reservation_info b ON a.info_id = b.id')
            ->join('LEFT JOIN lms_course c ON b.course_id = c.id')
            ->where("a.num_week = %d", $week)
            ->order("a.num_day, a.num_course")
            ->select();
        $weekShow = array();
        //初始化数组，一周7天，一天11节课 用来显示课程块（课程连起来的时候）
        for($i = 1; $i <= 7; $i ++){
            for($j = 1; $j <= 11; $j ++){
                $weekShow[$i][$j]['color'] = 0;
                $weekShow[$i][$j]['head'] = array($i, $j);
                $weekShow[$i][$j]['len'] = 1;
                $weekShow[$i][$j]['name'] = "";
            }
        }
        //相近的课写在一起
        $preid = $preDay = $preCourse = -1;
        foreach($nowCourse as $i => $v){
            if($preid != -1){
                if($preDay == $v['num_day'] && $preid == $v['info_id'] && $preCourse == $v['num_course'] - 1){
                    $pre = $weekShow[$preDay][$preCourse]['head'];
                    $weekShow[$pre[0]][$pre[1]]['len'] ++;
                    $weekShow[$preDay][$preCourse+1]['len'] = 0;
                    $weekShow[$preDay][$preCourse+1]['head'] = $pre;
                    $preid = $v['info_id'];
                    $preDay = $v['num_day'];
                    $preCourse = $v['num_course'];
                    continue;
                }
            }
            if(!$courseMap[$v['info_id']]){
                $res = $courseMap[$v['info_id']] = randColor();
            }
            else
                $res = $courseMap[$v['info_id']];
            $weekShow[$v['num_day']][$v['num_course']]['color'] = $res;
            $weekShow[$v['num_day']][$v['num_course']]['name'] = $v['name'];
            $preid = $v['info_id'];
            $preDay = $v['num_day'];
            $preCourse = $v['num_course'];
        }
        $this->assign("weekShow", $weekShow);
        $this->assign("week", $week);

        $courseModel = D('Course');
        $courseList = $courseModel->get_course_list();
        $this->assign('course', $courseList);
        $this->display();
    }

    public function course_list_by_week($week = 1){
        //当前显示第几周
//        $week = I('get.week', 1);
        $courseMap = array();
        //查询当前周的排课信息
        $nowCourse = $this->db
            ->alias('a')
            ->field('a.num_day, a.num_course, a.info_id, c.name')
            ->join('LEFT JOIN lms_reservation_info b ON a.info_id = b.id')
            ->join('LEFT JOIN lms_course c ON b.course_id = c.id')
            ->where("a.num_week = %d", $week)
            ->order("a.num_day, a.num_course")
            ->select();
        $weekShow = array();
        //初始化数组，一周7天，一天11节课 用来显示课程块（课程连起来的时候）
        for($i = 1; $i <= 7; $i ++){
            for($j = 1; $j <= 11; $j ++){
                $weekShow[$i][$j]['color'] = 0;
                $weekShow[$i][$j]['head'] = array($i, $j);
                $weekShow[$i][$j]['len'] = 1;
                $weekShow[$i][$j]['name'] = "";
            }
        }
        //相近的课写在一起
        $preid = $preDay = $preCourse = -1;
        foreach($nowCourse as $i => $v){
            if($preid != -1){
                if($preDay == $v['num_day'] && $preid == $v['info_id'] && $preCourse == $v['num_course'] - 1){
                    $pre = $weekShow[$preDay][$preCourse]['head'];
                    $weekShow[$pre[0]][$pre[1]]['len'] ++;
                    $weekShow[$preDay][$preCourse+1]['len'] = 0;
                    $weekShow[$preDay][$preCourse+1]['head'] = $pre;
                    $preid = $v['info_id'];
                    $preDay = $v['num_day'];
                    $preCourse = $v['num_course'];
                    continue;
                }
            }
            if(!$courseMap[$v['info_id']]){
                $res = $courseMap[$v['info_id']] = randColor();
            }
            else
                $res = $courseMap[$v['info_id']];
            $weekShow[$v['num_day']][$v['num_course']]['color'] = $res;
            $weekShow[$v['num_day']][$v['num_course']]['name'] = $v['name'];
            $preid = $v['info_id'];
            $preDay = $v['num_day'];
            $preCourse = $v['num_course'];
        }
        return $weekShow;
    }

    public function add_reservation(){
        if(IS_POST){
            $info =   I('post.');
            $oddWeek    =   $info['oddWeek'];
            $evenWeek   =   $info['evenWeek'];
            $parity = 0;
            if($oddWeek && $evenWeek){
                $parity = 2;
            }
            else if ($oddWeek){
                $parity = 1;
            }
            $reservationData = array(
                'firstWeek'     =>  $info['firstWeek'],
                'lastWeek'      =>  $info['lastWeek'],
                'firstDay'      =>  $info['firstDay'],
                'lastDay'       =>  $info['lastDay'],
                'parity'        =>  $parity,
                'firstCourse'   =>  $info['firstTime'],
                'lastCourse'    =>  $info['lastTime'],
            );
            $infoData = array(
                'courseId'          =>  $info['courseid'],
                'studentCategory'   =>  $info['studentCategory'],
                'CourseCategory'    =>  $info['CourseCategory'],
                'software'          =>  $info['software'],
                'remark'            =>  $info['remark']
            );
            $result = $this->db->insert_reservation($reservationData, $infoData);
//            if($result['status'] == 1){
//                echo "success";
//            }
//            else{
//                echo "fail";
//            }
//
            echo json_encode($result);
            exit;
        }
    }
}