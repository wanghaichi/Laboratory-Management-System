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
    protected $tableName = 'reservation_list';

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
        return "213";

    }
    /**
     * @param int $firstWeek                    从第几周
     * @param int $lastWeek                     到第几周
     * @param int $firstDay                     从周几
     * @param int $lastDay                      到周几
     * @param int $firstCourse                  从第几节
     * @param int $lastCourse                   到第几节
     * @param int $parity 0:even 1:odd 2:both   单双周
     * @return array                            插入信息
     */
    public function insert_reservation($reservationData, $infoData){
        $firstWeek  = $reservationData['firstWeek'];
        $lastWeek   = $reservationData['lastWeek'];
        $firstDay   = $reservationData['firstDay'];
        $lastDay    = $reservationData['lastDay'];
        $firstCourse= $reservationData['firstCourse'];
        $lastCourse = $reservationData['lastCourse'];
        $parity     = $reservationData['parity'];
        $result = $this->check_reservation($reservationData);
        $res = array();
        if($result){
            $infoModel = D('CourseInfo');
            $infoModel->startTrans();
            $infoRes = $infoModel->insert_info($infoData);
            if($infoRes['status'] == 1){
                $infoId = $infoRes['id'];
                $this->startTrans();
                $flag = true;

                for($i = $firstWeek; $i <= $lastWeek; $i ++){
                    if($parity == 0 && ($i % 2 == 1))
                        continue;
                    if($parity == 1 && ($i % 2 == 0))
                        continue;
                    for($j = $firstDay; $j <= $lastDay; $j ++){
                        for($k = $firstCourse; $k <= $lastCourse; $k ++){
                            $data = array(
                                'info_id'   => $infoId,
                                'num_week'  => $i,
                                'num_day'   => $j,
                                'num_course'=> $k,
                            );
                            $flag = $this->add($data) && $flag;
                        }
                    }
                }
                if($flag){
                    $infoModel->commit();
                    $this->commit();
                    $res['status'] = 1;
                }
                else{
                    $infoModel->rollback();
                    $this->rollback();
                    $res['status'] = 0;
                }
                return $res;
            }
            else{
                $res['status'] = 0;
                $res['msg'] = "插入失败";
                return $res;
            }
        }
        else{
            $res['status'] = 0;
            $res['msg'] = $result;
            return $res;
        }
    }

    public function check_reservation($reservationData){
        $firstWeek  = $reservationData['firstWeek'];
        $lastWeek   = $reservationData['lastWeek'];
        $firstDay   = $reservationData['firstDay'];
        $lastDay    = $reservationData['lastDay'];
        $firstCourse= $reservationData['firstCourse'];
        $lastCourse = $reservationData['lastCourse'];
        $parity     = $reservationData['parity'];
        return true;
    }
}
















