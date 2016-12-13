<?php
/**
 * Created by PhpStorm.
 * User: hardy
 * Date: 16-10-18
 * Time: 下午2:49
 */

namespace Home\Model;
use Think\Model;
class ReservationInfoModel extends Model {
    protected $tableName = 'reservation_info';


    public function insert_info($infoData){
        $courseId           = $infoData['courseId'];
        $software           = $infoData['software'];
        $studentCategory    = $infoData['studentCategory'];
        $remark             = $infoData['remark'];
        $CourseCategary      = $infoData['CourseCategary'];

        $data = array(
            'course_id'         => $courseId,
            'software'          => $software,
            'student_category'  => $studentCategory,
            'remark'            => $remark,
            'class_category'    =>  $CourseCategary,
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
















