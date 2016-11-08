<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>排课表</title>
    <link rel="stylesheet" type="text/css" href="/Laboratory-Management-System/Public/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Laboratory-Management-System/Public/dist/css/Schedule.css" />
    <script src="/Laboratory-Management-System/Public/dist/js/jquery-3.1.0.min.js" type="javascript"></script>
    <script src="/Laboratory-Management-System/Public/dist/js/bootstrap.min.js" type="javascript"></script>
</head>
<body>
<div class="container-fluid">
    <div class="col-lg-8 col-lg-offset-2">
        <table class="table table-bordered">
            <tr><th>十月</th><th>星期一</th><th>星期二</th><th>星期三</th><th>星期四</th>
                <th>星期五</th><th>星期六</th><th>星期日</th></tr>
            <tr><th>1</th><td rowspan="2" bgcolor="#faebd7">软件工程概论</td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>2</th><td></td><td bgcolor="#f0ffff">编译原理</td><td></td><td></td>
                <td></td><td></td><td hidden="true"></td></tr>
            <tr><th>3</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>4</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>5</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>6</th><td></td><td bgcolor="#fff8dc">操作系统原理</td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>7</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>8</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>9</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>10</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
            <tr><th>11</th><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td></tr>
        </table>

        <div style="border: solid 1px lightgray; padding: 2% 4%">
            <form role="form" class="form-inline" action="<?php echo U('index');?>" method="post">

                <div class="row">
                    <div class="col-xs-6">
                        <label for="selectFirstWeek">选择周数</label>
                        <select id="selectFirstWeek" name="firstWeek" class="form-control">
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
                            <option value="18">18</option>
                        </select>
                        <select id="selectLastWeek" name="lastWeek" class="form-control">
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
                            <option value="18">18</option>
                        </select>
                    </div>
                    <div class="col-xs-6">
                        <label for="selectFirstDay" class="labelRight">选择星期几</label>
                        <select id="selectFirstDay" class="form-control" name="firstDay">
                            <option value="1">星期一</option>
                            <option value="2">星期二</option>
                            <option value="3">星期三</option>
                            <option value="4">星期四</option>
                            <option value="5">星期五</option>
                            <option value="6">星期六</option>
                            <option value="7">星期日</option>
                        </select>
                        <select for="selectLastDay" class="form-control" name="lastDay">
                            <option value="1">星期一</option>
                            <option value="2">星期二</option>
                            <option value="3">星期三</option>
                            <option value="4">星期四</option>
                            <option value="5">星期五</option>
                            <option value="6">星期六</option>
                            <option value="7">星期日</option>
                        </select>
                    </div>
                </div><br/><br/>
                <div class="row">
                    <div class="col-xs-6">
                        <label>选择单双周</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="oddWeek">
                                单周
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="evenWeek">
                                双周
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <label class="labelRight" for="selectFirstTime">选择课程时间</label>
                        <select id="selectFirstTime" class="form-control" name="firstTime">
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
                        </select>
                        <select id="selectLastTime" class="form-control" name="lastTime">
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
                        </select>
                    </div><br/><br/><br/>
                    <div class="row">
                        <div class="col-xs-3 col-xs-offset-8">
                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-primary" style="margin-left: 5%" name="submit">点击查询</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>