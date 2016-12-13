<?php
/**
 * Created by PhpStorm.
 * User: hardy
 * Date: 16-10-18
 * Time: 下午2:49
 */

namespace Home\Model;
use Think\Model;
class ReservationModel extends Model {
    protected $tableName = 'reservation_list';

    public function __construct()
    {
        parent::__construct();
    }
    //本学期的第一天
    public function get_first_day(){
        //2016年八月二十二日
        return 1471795200;
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
    //判断当前属于第几周，参数为待求日期时间戳，否则为当前时间
    public function get_week($time = -1){
        $time = $time == -1 ? time() : $time;
        $days = (time() - $this->get_first_day())/3600/24;
        $weeks = $days / 7;
        return ceil($weeks);
    }
//    public function test(){
//        echo md5('admin');
//
//    }
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
        if($result['status'] == 'ok'){
            $infoModel = D('ReservationInfo');
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
            $res['msg'] = $result['msg'];
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
        $paArr = array();
        if($parity == 0)
            $paArr = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20');
        else if ($parity == 1)
            $paArr = array('1', '3', '5', '7', '9', '11', '13', '15', '17', '19');
        else
            $paArr = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '1', '3', '5', '7', '9', '11', '13', '15', '17', '19');
        $map = array(
            'num_week'  => array(
                    array('BETWEEN', "$firstWeek, $lastWeek"),
                    array('IN', $paArr),
                ),
            'num_day'   => array('BETWEEN', "$firstDay, $lastDay"),
            'num_course' => array('BETWEEN', "$firstCourse, $lastCourse"),
        );
        $res = $this
            ->alias('a')
            ->join('LEFT JOIN lms_reservation_info b ON a.info_id = b.id')
            ->where($map)->select();
        //查看当前冲突的课程
        if($res){
            $res['status'] = 'error';
        }
        else{
            $res['status'] = 'ok';
        }
        return $res;
    }
}
















