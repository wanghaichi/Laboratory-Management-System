<?php
/**
 * Created by PhpStorm.
 * User: yunhao
 * Date: 2016/12/13
 * Time: 15:42
 */

namespace Admin\Model;
use Think\Model;

class CourseModel extends Model{
    protected $tableName = 'reservation_info';

    public function getAllData(){
        $data = $this->join(array(' INNER JOIN lms_course ON lms_course.id = lms_reservation_info.course_id', ' INNER JOIN lms_reservation_list ON lms_reservation_list.info_id = lms_reservation_info.id'))
            ->select();
        return $data;
    }

    public function checkData($courseName, $danShuangZhou, $startWeek, $endWeek, $startDay, $endDay, $startTime, $endTime){
        $sql = "";
        $cnt = 0;
        if($courseName != ""){
            $sql .= " name = '".$courseName."' ";
            $cnt++;
        }
        if($startWeek != 0){
            if($cnt > 0) $sql .= " AND ";
            $sql .= " num_week >= ".$startWeek." ";
            $cnt++;
        }
        if($endWeek != 0){
            if($cnt > 0) $sql .= " AND ";
            $sql .= " num_week <= ".$endWeek." ";
            $cnt++;
        }
        if($startDay != 0){
            if($cnt > 0) $sql .= " AND ";
            $sql .= " num_day >= ".$startDay." ";
            $cnt++;
        }
        if($endDay != 0){
            if($cnt > 0) $sql .= " AND ";
            $sql .= " num_day <= ".$endDay." ";
            $cnt++;
        }
        if($startTime != 0){
            if($cnt > 0) $sql .= " AND ";
            $sql .= " num_day >= ".$startTime." ";
            $cnt++;
        }
        if($endTime != 0){
            if($cnt > 0) $sql .= " AND ";
            $sql .= " num_day <= ".$endTime." ";
            $cnt++;
        }

        $data = $this->join(array(' INNER JOIN lms_course 
            ON lms_course.id = lms_reservation_info.course_id',
            ' INNER JOIN lms_reservation_list 
            ON lms_reservation_list.info_id = lms_reservation_info.id'))
            ->where($sql)
            ->select();

        if($danShuangZhou != '0'){
            for ($i = 0; $data[$i]; $i++){
                if($data[$i]['num_week'] % 2 == $danShuangZhou % 2)
                    unset($data[$i]);
            }
        }
        return $data;
    }

    public function deleteData($listId){
        $list = D('reservation_list');
        $list->where(array('id'=>$listId))->delete();
    }

}
