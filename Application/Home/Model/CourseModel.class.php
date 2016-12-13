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
    protected $tableName = 'course';

    public function __construct()
    {
        parent::__construct();
}

    public function get_course_list(){
        return $this->select();
    }
}
















