<?php
/**
 * Created by PhpStorm.
 * User: hardy
 * Date: 16-10-18
 * Time: 下午2:49
 */

namespace Home\Model;
use Think\Model;
class CourseInfoModel extends Model {
    protected $tableName = 'reservation_info';


    public function insert_info($infoData){
        $teacherName        = $infoData['teacherName'];
        $courseId           = $infoData['courseId'];
        $software           = $infoData['software'];
        $studentCategory    = $infoData['studentCategory'];
        $remark             = $infoData['remark'];
        $classCategary      = $infoData['classCategary'];

        $teacherName        = "王海弛";
        $courseId           = "45678932";
        $software           = "PhotoShop";
        $studentCategory    = "0";
        $remark             = "需要多媒体";
        $classCategary      = "0";
        $data = array(
            'teacher_name'      => $teacherName,
            'course_id'         => $courseId,
            'software'          => $software,
            'student_category'  => $studentCategory,
            'remark'            => $remark,
            'class_category'    =>  $classCategary,
        );
        $result = $this->add($data);
        $id = $this->getLastInsID();
        $res = array();
        if($result){
            $res['status'] = 1;
            $res['id'] = $id;
        }
        else{
            $res['status'] = 0;
        }
        return $res;
    }
}
















