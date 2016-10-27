<?php
/**
 * Created by PhpStorm.
 * User: hardy
 * Date: 16-10-18
 * Time: 下午2:49
 */

namespace Home\Model;
use Think\Model;
class CourseModel extends Model {
    protected $tableName = 'reservation_info';

    public function __construct()
    {
        parent::__construct();
    }

    //用来判断当前的年份，以开学的年份为主，比如2016年8月到2017年7月都属于2016学期
    public function get_now_year(){
        $nowYear = date("Y", time());
        $nowMonth = date("m", time());
        if($nowMonth <= 7){
            $nowYear -= 1;
        }
        return $nowYear;
    }

    public function test(){


    }
    /**
     * @param int $firstWeek 从第几周
     * @param int $lastWeek 到第几周
     * @param int $firstCourse 从第几节
     * @param int $lastCourse 到第几节
     * @param int $parity 0:even 1:odd 2:both 单双周
     */
    public function insert_reservation($firstWeek, $lastWeek, $firstCourse, $lastCourse, $parity){
        $result = $this->check_reservation($firstWeek, $lastWeek, $firstCourse, $lastCourse, $parity);

    }

    public function check_reservation($firstWeek, $lastWeek, $firstCourse, $lastCourse, $parity){

    }
}
















