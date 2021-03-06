<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>排课表</title>
    <link rel="stylesheet" type="text/css" href="/Public/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/dist/css/Schedule.css" />
    <link rel="stylesheet" href="/Public/sweetalert/sweetalert2.min.css" type="text/css"/>
    <script src="/Public/dist/js/jquery-3.1.0.min.js" type="text/javascript"></script>
    <script src="/Public/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/dist/js/Course/reservation.js" type="text/javascript"></script>
    <script src="/Public/sweetalert/sweetalert2.min.js" type="text/javascript"></script>

</head>

<body>
<div class="container-fluid">
    <div class="col-lg-8 col-lg-offset-2">
        <table  class="table table-bordered">
            <tr>
                <th>第<?php echo ($week); ?>周</th>
                <th>星期一</th>
                <th>星期二</th>
                <th>星期三</th>
                <th>星期四</th>
                <th>星期五</th>
                <th>星期六</th>
                <th>星期日</th>
            </tr>
            <?php for($i = 1; $i <= 11; $i ++){ echo "<tr>"; echo "<th>$i</th>"; for($j = 1; $j <= 7; $j ++){ if(strlen($weekShow[$j][$i]['color']) > 1){ echo "<td rowspan=".$weekShow[$j][$i]['len']." bgcolor=".$weekShow[$j][$i]['color']." >".$weekShow[$j][$i]['name']."</td>"; } else if ($weekShow[$j][$i]['len'] == 1){ echo "<td></td>"; } } echo "</tr>"; } ?>
        </table>
        <div style="border: solid 1px lightgray; padding: 2% 4%">
            <form id="form1" role="form" class="form-inline" action="<?php echo U('add_reservation');?>" method="post">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="courseid">课程名称</label><br/>
                            <select id="courseid" name="courseid" class="form-control">
                                <option value="_blank"></option>
                                <?php if(is_array($course)): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="software">所需软件</label>
                            <input type="text" class="form-control" id="software" name="software" placeholder="">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="remark">备注</label>
                            <input type="text" class="form-control" id="remark" name="remark" placeholder="">
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="row">
                    <div class="col-xs-6">
                        <label for="studentCategory">学生类型</label>
                        <select id="studentCategory" name="studentCategory" class="form-control">
                            <option value="_blank"></option>
                            <option value="0">本科生</option>
                            <option value="1">硕士生</option>
                            <option value="2">博士生</option>
                        </select>
                    </div>
                    <div class="col-xs-6">
                        <label for="CourseCategory">教室类型</label>
                        <select id="CourseCategory" name="CourseCategory" class="form-control">
                            <option value="_blank"></option>
                            <option value="0">上课</option>
                            <option value="1">临时使用</option>
                        </select>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="row">
                    <div class="col-xs-6">
                        <label for="selectFirstWeek">选择周数</label>
                        <select id="selectFirstWeek" name="firstWeek" class="form-control">
                            <option value="_blank"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option></select>
                        <select id="selectLastWeek" name="lastWeek" class="form-control">
                            <option value="_blank"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option></select>
                    </div>
                    <div class="col-xs-6">
                        <label for="selectFirstDay" class="labelRight">选择星期几</label>
                        <select id="selectFirstDay" class="form-control" name="firstDay">
                            <option value="_blank"></option>
                            <option value="1">星期一</option>
                            <option value="2">星期二</option>
                            <option value="3">星期三</option>
                            <option value="4">星期四</option>
                            <option value="5">星期五</option>
                            <option value="6">星期六</option>
                            <option value="7">星期日</option></select>
                        <select id="selectLastDay" class="form-control" name="lastDay">
                            <option value="_blank"></option>
                            <option value="1">星期一</option>
                            <option value="2">星期二</option>
                            <option value="3">星期三</option>
                            <option value="4">星期四</option>
                            <option value="5">星期五</option>
                            <option value="6">星期六</option>
                            <option value="7">星期日</option>
                        </select>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="row">
                    <div class="col-xs-6">
                        <label>选择单双周</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="oddWeek" name="oddWeek">单周</label></div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="evenWeek" name="evenWeek">双周</label></div>
                    </div>
                    <div class="col-xs-6">
                        <label class="labelRight" for="selectFirstTime">选择课程时间</label>
                        <select id="selectFirstTime" class="form-control" name="firstTime">
                            <option value="_blank"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option></select>
                        <select id="selectLastTime" class="form-control" name="lastTime">
                            <option value="_blank"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option></select>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-xs-3 col-xs-offset-8">
                            <div class="col-xs-6">
                                <button type="button" class="btn btn-primary" style="margin-left: 5%" name="submit" onclick="return check_reservation(this);">点击查询</button></div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</body>

</html>