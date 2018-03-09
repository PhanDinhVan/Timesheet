// chart_user

$('#from').datepicker({
    changeMonth:true,
    changeYear:true,
    format:'yyyy-mm-dd',
    autoclose: true
});

$('#to').datepicker({
    changeMonth:true,
    changeYear:true,
    format:'yyyy-mm-dd',
    autoclose: true
});

$(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
});

function changeData(){
    document.getElementById("chart").innerHTML = "";
    var e = document.getElementById("sel1");
    var id = e.options[e.selectedIndex].value;
    var name = e.options[e.selectedIndex].text;
    var from = $('#from').val();
    var to = $('#to').val();
    var project_Name = [];
    var time_Working = [];
    var data2 = [];


    if(id){
        $.ajax({
            type : 'get',
            url : 'admin/report_chart/getchartUsers',
            data : {'id':id,'from':from,'to':to},
            success:function(data){
                // console.log(data)
                data.forEach(function(element) {
                    // var project_id = element.project_id;
                    var time = parseInt(element.time);
                    var user_id = element.user_id;
                    // console.log(element.project_name + '  ' + element.time);
                    if(user_id){
                      time_Working.push(time);
                      project_Name.push(element.project_name);
                    }
                });
                console.log(time_Working)

                if(project_Name){
                    for(var i=0; i<project_Name.length; i++)  {
                        data2.push({minutes: time_Working[i], project_name: project_Name[i]});
                    }

                    d3plus.viz()
                                .container(".chart")
                                .data(data2)
                                .type("pie")
                                .id("project_name")
                                .size("minutes")
                                .format({
                                    "text": function(text, params) {
                                        
                                        if (text === "minutes") {
                                            return "Time Working";
                                        }
                                        else {
                                            return d3plus.string.title(text, params);
                                        }
                                        
                                    },
                                        "number": function(number, params) {
                                        
                                        var formatted = d3plus.number.format(number, params);
                                        var time = params.data.minutes;
                                        // console.log(time)
                                        var day = Math.floor(time/480);
                                        var time_surplus = time%480;
                                        var hours = Math.floor(time_surplus/60);
                                        var minutes = time_surplus%60;

                                        if(minutes < 10){
                                            minutes = '0'+minutes;
                                        }

                                        time_working = day + ' days' + ' - ' + '0'+hours + ' : ' + minutes;

                                        if (params.key === "minutes") {
                                            return time_working;
                                        }
                                        else {
                                            return formatted;
                                        }
                                        
                                    }
                                })
                                .draw()
                }

            }
        })
    }
    else{

        // alert("Please select username!");
        $('#select_username').modal('show');
    }
    
}