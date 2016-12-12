/**
 * Created by hardy on 16-12-12.
 */

function user_login(){
    var user_number = document.getElementById("user_number").value;
    var user_password = document.getElementById("user_password").value;
    $.ajax({
        type: 'POST',
        url: '/Home/User/login',
        data: {user_number:user_number, user_password:user_password},
        success: function (data) {
              if(data.status == 1){
                  swal({
                      type: 'success',
                      title: 'Successful',
                      timer: 1000
                  }).then(
                      function () {},
                      // handling the promise rejection
                      function (dismiss) {
                          if (dismiss === 'timer') {
                              window.location.href = '/Home/Course';
                          }
                      }
                  );
              }
              else{
                  swal({
                      type:     'error',
                      title:    'Error',
                      text:     data.msg,
                      timer:    2000
                  }).then(
                      function () {},
                      // handling the promise rejection
                      function (dismiss) {
                          if (dismiss === 'timer') {

                          }
                      }
                  );
              }
        },
        dataType: 'json',
        error:  function (data) {
            // alert(data.status + data.msg);
        }
    });

}