@extends('admin.layout.index')
@section('content')

<style>
    .chart {
        height: 300px;
        margin: 0 auto;                            
        position: relative;
        width: 300px;
    }
   /* label{
        float: left;
        margin-right: 1%;
        margin-top: 0.5%;
    }*/
    /*#sel1{
        width: 20%;
        float: left;
    }
    .btn-info{
        margin-left: 5%;
    }
    .date{
        width: 67%; 
        margin-left: 5%;
        text-align: center;
    }*/
    .show-report-info{
        text-align: center;
        margin-top: 2%;
    }
    /*.panel-body{
        padding-bottom: 4px;
    }*/
</style>


<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2 class="m-t-0 m-b-20 header-titles"><b>Chart Report Customer</b></h2>

            <div class="col-lg-7">
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}    
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-9">

                    <div class="p-20">
                        <form class="form-horizontal">
                            
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="col-form-label">From</label>
                                    <input type="text" name="from" id="from" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" >
                                </div>

                                <div class="col-md-3">
                                    <label class="col-form-label">To</label>
                                    <input type="text" name="to" id="to" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class=" col-md-3">
                                    <label class="col-form-label">Select customer</label>
                                    <select class="form-control" id="select_customer">
                                        <option></option>
                                        @foreach($customer as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-md-3 offset-md-3">
                                    <button type="button" class="btn btn-info" id="searchCustomer" onclick="changeData()">
                                        <span class="glyphicon glyphicon-search"></span> Search
                                    </button>
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>

            <div class="show-report-info">
                
                <div class ="chart" id="chart"></div>
            </div>
                
        </div>
    </div>
</div>

@include('error.messages')


@endsection

@section('script')

<script src="js/d3js/d3.js"></script>
<script src="js/d3js/d3plus.js"></script>
<!-- <script src="js/report/chart_customer"></script> -->

<script>

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
        var e = document.getElementById("select_customer");
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
            // alert("Please select customer name!");
            $('#select_customer_name').modal('show');
        }
        
    }

    $(document).ready(function(){
        $('#chart_customer').multiSelect();
    });
</script>
	
@endsection
