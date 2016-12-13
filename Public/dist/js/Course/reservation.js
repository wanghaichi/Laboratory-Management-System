/**
 * Created by hardy on 16-12-13.
 */
/**
 * Created by hardy on 16-12-12.
 */

function check_reservation(){
    var form            =   document.getElementById("form1");
    var courseid        =   form.elements['courseid'];
    var software        =   form.elements["software"];
    var remark          =   form.elements["remark"];
    var studentCategory =   form.elements["studentCategory"];
    var CourseCategory  =   form.elements["CourseCategory"];
    var selectFirstWeek =   form.elements["selectFirstWeek"];
    var selectLastWeek  =   form.elements["selectLastWeek"];
    var selectFirstDay  =   form.elements["selectFirstDay"]
    var selectLastDay   =   form.elements["selectLastDay"];
    var oddWeek         =   form.elements["oddWeek"];
    var evenWeek        =   form.elements["evenWeek"];
    var selectFirstTime =   form.elements["selectFirstTime"];
    var selectLastTime  =   form.elements["selectLastTime"];
    var msg = "";
    var flag = true;
    if(courseid.value == "_blank"){
        msg = "课程名称不能为空";
        flag = false;
    }
    else if (studentCategory.value == "_blank"){
        msg = "学生类型不能为空";
        flag = false;
    }
    else if (CourseCategory.value == "_blank"){
        msg = "教室类型不能为空";
        flag = false;
    }
    else if (selectFirstWeek.value == "_blank" || selectLastWeek.value == "_blank" || selectFirstWeek.value > selectLastWeek.value){
        msg = "周次输入不合法";
        flag = false;
    }
    else if (selectFirstDay.value == "_blank" || selectLastDay.value == "_blank" || selectFirstDay.value > selectLastDay.value){
        msg = "星期输入不合法";
        flag = false;
    }
    else if (!oddWeek.checked && !evenWeek.checked){
        msg = "请选择单双周";
        flag = false;
    }
    else if (selectFirstTime.value == "_blank" || selectLastTime.value == "_blank" || selectFirstTime.value > selectLastTime.value){
        msg = "课程时间输入不合法";
        flag = false;
    }
    if(flag){
        add_reservation();
    }
    else{
        swal({
            type: 'error',
            title: 'error',
            text:  msg
        });
    }
}

function add_reservation(){
    $.ajax({
        type: 'POST',
        url: '/Home/Course/add_reservation',
        data: $("#form1").serialize(),
        success: function (data) {
            if(data.status == 1){
                swal({
                    title: 'success',
                    type: 'success',
                    text: "添加成功",
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '确认'
                }).then(function () {
                    window.location.reload()
                });
            }
            else{
                swal({
                    type: 'error',
                    title: 'error',
                    text:  data.msg
                });
            }
        },
        dataType: 'json',
        error:  function (data) {
            // alert(data.status + data.msg);
        }
    });
}