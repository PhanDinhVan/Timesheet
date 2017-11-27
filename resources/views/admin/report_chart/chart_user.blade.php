@extends('admin.layout.index')
@section('content')

<style>
    .chart {
        height: 300px;
        margin: 0 auto;                            
        position: relative;
        width: 300px;
    }
    label{
        float: left;
        margin-right: 1%;
        margin-top: 0.5%;
    }
    #sel1{
        width: 20%;
        float: left;
    }
    .btn-info{
        margin-left: 5%;
    }
    .date{
        width: 50%; 
        margin-left: 5%;
    }
    .show-report-info{
        text-align: center;
        margin-top: 2%;
    }
    .panel-body{
        padding-bottom: 4px;
    }
</style>

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chart report
                        <small>Users</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7">
                        
                </div>
            </div>
            <!-- /.row -->

            <div class="panel panel-default">
              <div class="panel-heading">
                <table>
                  <tr>
                    <td><b>From </b></td>
                    <td>
                      <input type="text" name="from" id="from" class="form-control date" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}">
                    </td>
                    <td><b>To </b></td>
                    <td>
                      <input type="text" name="to" id="to" class="form-control date" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}">
                    </td>
                  </tr>
                </table>
              </div>

              <div class="panel-body">
                <label>Select users</label>
                <select class="form-control" id="sel1">
                  <option></option>
                  @foreach($user as $value)
                    <option value="{{ $value->id }}">{{ $value->firstname }} {{ $value->lastname }}</option>
                  @endforeach
                </select>
                <button onClick="changeData()" class="btn btn-info">Go <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
              </div>
                
              <div class="show-report-info">
                 <div class ="chart" id="chart"></div>
              </div>

              
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>



@endsection

@section('script')
  
<script src="js/d3js/d3.js"></script>
<script src="js/d3js/d3plus.js"></script>

<script type="text/javascript">
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
            alert("Please select customer name!");
        }
        
    }
</script>


@endsection
