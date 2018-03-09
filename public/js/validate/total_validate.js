/* -----  Start page user/readByAjax  -----*/
$(document).ready(function() {

    $(".username").hide(); 
    var position = $("#position").val(); 
    if(position == 1){
        $(".username").show(); 
    }

    // var working_time = $("#working_time").val();
    // setting working time
    var temp = $('table tbody .working_time');
    temp.each(function() {
        var a = $(this);
        var total_minutes = a.text();
        var hours = Math.floor(total_minutes/60);

        //format time 00:00
        var count = hours.toString().length;
        if(count < 2){
            hours = '0'+hours;
        }
       
        var minutes = total_minutes%60;
        var count2 = minutes.toString().length;
        if(count2 < 2){
            minutes = '0'+minutes;
        }

        working_time = hours + ':' + minutes;
        // alert(working_time);
        a.text(working_time);
    });

    // setting overtime
    var temp2 = $('table tbody .overtime');
    temp2.each(function() {
        var a = $(this);
        var total_minutes = a.text();
        var hours = Math.floor(total_minutes/60);

        //format time 00:00
        var count = hours.toString().length;
        if(count < 2){
            hours = '0'+hours;
        }
       
        var minutes = total_minutes%60;
        var count2 = minutes.toString().length;
        if(count2 < 2){
            minutes = '0'+minutes;
        }

        overtime = hours + ':' + minutes;
        // alert(working_time);
        a.text(overtime);
    });

    // setting date_time_entries
    // var temp3 = $('table tbody .date_time_entries');
    // temp3.each(function() {
    //     var a = $(this);
    //     var date_time = a.text();
    //     var myDate = new Date(date_time);
    //     var month =  myDate.getMonth() + 1;

    //     var full_date = myDate.getFullYear() + "-" + month + "-" + myDate.getDate();
    //     // alert(full_date);
    //     a.text(full_date);

    // });

})

// get value from delete-row and set value remove-row
$(document).on('click','.delete-row',function(e){
    // get value the a
    var id = $(this).attr('href');
    $('#id_delete').val(id);
})
/* -----  End page readByAjax  -----*/


/* -----  Start page user  -----*/

// setting date_time_entries
// var start_date = $('table tbody .start_date');
// start_date.each(function() {
//     var a = $(this);
//     var date_time = a.text();
//     var myDate = new Date(date_time);
//     var month =  myDate.getMonth() + 1;

// var full_date = myDate.getFullYear() + "-" + month + "-" + myDate.getDate();
// // alert(full_date);
// a.text(full_date);

// });


// var end_date = $('table tbody .end_date');
// end_date.each(function() {
//     var a = $(this);
//     var date_time = a.text();
//     var myDate = new Date(date_time);
//     var month =  myDate.getMonth() + 1;

// var full_date = myDate.getFullYear() + "-" + month + "-" + myDate.getDate();
// // alert(full_date);
// a.text(full_date);

// });

// popup modal delete user
$(document).on('click','.delete-user',function(e){
    // get value the a
    var id = $(this).attr('href');
    // $('#id_delete_user').val(id);
    $("#id_delete_user").attr("href", "admin/user/delete/"+id);
})
/* -----  End page user  -----*/


/* -----  Start page task  -----*/
$(document).on('click','.delete-task',function(e){
    // get value the a
    var id = $(this).attr('href');
    // $('#id_delete_user').val(id);
    $("#id_delete_task").attr("href", "admin/task/delete/"+id);
})
/* -----  End page task  -----*/

/* -----  Start page project  -----*/
$(document).on('click','.delete-project',function(e){
    // get value the a
    var id = $(this).attr('href');
    $("#id_delete_project").attr("href", "admin/project/delete/"+id);
})
/* -----  End page project  -----*/

/* -----  Start page customer  -----*/
$(document).on('click','.delete-customer',function(e){
    // get value the a
    var id = $(this).attr('href');
    $("#id_delete_customer").attr("href", "admin/customer/delete/"+id);
})
/* -----  End page customer  -----*/

/* -----  Start page employee_type  -----*/
$(document).on('click','.delete-employee-type',function(e){
    // get value the a
    var id = $(this).attr('href');
    $("#id_delete_employee_type").attr("href", "admin/employee_type/delete/"+id);
})
/* -----  End page employee_type  -----*/

/* -----  Start page Permisson  -----*/
$(document).on('click','.delete-permisson',function(e){
    // get value the a
    var id = $(this).attr('href');
    $("#id_delete_permisson").attr("href", "admin/permisson/delete/"+id);
})
/* -----  End page Permisson  -----*/