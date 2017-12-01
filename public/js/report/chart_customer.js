$('#from').datepicker({
    changeMonth:true,
    changeYear:true,
    format:'yyyy-mm-dd'
});

$('#to').datepicker({
    changeMonth:true,
    changeYear:true,
    format:'yyyy-mm-dd'
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

    var project_temp = 0;
    // use get list time (a,c,will)
    var a;
    var c = [];
    var will = [];
    var a1;
    var c1 = [];
    var will1 = [];
    var count = 0;
    var data2 = [];


    if(id){
        $.ajax({
            type : 'get',
            url : 'admin/report_chart/getchart',
            data : {'id':id,'from':from,'to':to},
            success:function(data){
                // console.log(data)
                data.forEach(function(element) {
                    var project_id = element.project_id;
                    // console.log(element.project_id + '  ' + element.lastname + '  ' + element.time);
                    var time = parseInt(element.time);
                    if(project_id == project_temp){
                        // alert(project_id+'hay lam'+project_temp)
                        will.push(time);
                        will1.push(element.lastname);
                    }
                    else{
                        if(will.length == 0){
                            // alert('lan dau')
                            project_temp = project_id;
                            will.push(time);
                            will1.push(element.lastname);
                        }
                        else{
                            count++;
                            // console.log(will)
                            a = will;
                            c.push(will);
                            will = [];

                            a1 = will1;
                            c1.push(will1);
                            will1 = [];
                            // alert('lan sau'+project_id+'khac'+project_temp)
                            project_temp = project_id;  
                            will.push(time);
                            will1.push(element.lastname);
                        }
                    }
                });

                //------------- Begin for -------------------
                for(var k = 0; k < c.length; k++){
                    var b = c[k];
                    var label = c1[k];
                    // console.log(b)

                    if(b){
                        for(var i=0; i<b.length; i++)  {
                            data2.push({minutes: b[i], lastname: label[i]});
                        }
                    }

                    if(id){
                        if(data2.length > 0){
                            var i = 1;
                            d3plus.viz()
                                .container(".chart")
                                .data(data2)
                                .type("pie")
                                .id("lastname")
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

                            data2 = [];

                        }
                        else{
                            x.style.display = "none";
                        }
                    }
                    else{
                        x.style.display = "none";
                    }
                }
                //------------- Finish for -------------------

                if(will){
                    for(var i=0; i<will.length; i++)  {
                        data2.push({minutes: will[i], lastname: will1[i], name:'name'});
                    }

                    // format rat quan trong, no dung de thay doi lai dinh dang cua value
                    d3plus.viz()
                        .container(".chart")
                        .data(data2)
                        .type("pie")
                        .id("lastname")
                        // .color("lastname")
                        // .legend({"size": 40})
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
                                    // return "$" + formatted + " USD";
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
        alert("Please select customer name!");
    }
    
}