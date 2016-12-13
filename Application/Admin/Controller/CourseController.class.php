<?php
namespace Admin\Controller;
use Think\Controller;
class CourseController extends Controller {
    public function index()
    {
        $wang = A('Home/Course');
        $week = I('get.week');
        $weekShow = $wang->course_list_by_week($week);
        $this->assign('weekShow', $weekShow);

        $info = D('Course');
        $courseName = I('get.courseName');
        $danShuangZhou = I('get.danshuangzhou');
        $startWeek = I('get.firstWeek');
        $endWeek = I('get.lastWeek');
        $startDay = I('get.firstDay');
        $endDay = I('get.lastDay');
        $startTime = I('get.firstTime');
        $endTime = I('get.lastTime');

        $flag = false;
        if($courseName != "" || $danShuangZhou != 0 || $startWeek != 0 || $endWeek != 0 || $startDay != 0 || $endDay != 0 || $startTime != 0 || $endTime != 0)
            $flag = true;
        if($startWeek > $endWeek || $startDay > $endDay || $startTime > $endTime){
            $flag = false;
        }
        if($flag){
            $data = $info->checkData($courseName, $danShuangZhou, $startWeek, $endWeek, $startDay, $endDay, $startTime, $endTime);
            $this->assign('alldata', $data);
        }
        else{
            $data = $info->getAllData();
            $this->assign('alldata', $data);
        }
        $this->display('empty');
    }

    public function deleteData(){
        $list = D('Course');
        $deleteItem = I('post.deleteItem');
        for ($i = 0; $deleteItem[$i]; $i++){
            $list->deleteData($deleteItem[$i]);
        }
        echo json_encode($deleteItem);
    }

}