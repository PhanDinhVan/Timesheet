@extends('admin.layout.index')
@section('content')

<style>

.chart {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  width: 960px;
  height: auto;
  position: relative;
  display: none;
}
path.slice{
	stroke-width:2px;
}
polyline{
	opacity: .3;
	stroke: black;
	stroke-width: 2px;
	fill: none;
} 
svg text.percent{
	fill:white;
	text-anchor:middle;
	font-size:12px;
}

</style>



<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="margin: 0px;" class="page-header">Report
                        <small>Customer</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7">
                  @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}    
                    </div>
                  @endif
                </div>
            </div>
            <!-- /.row -->
            <div class="panel panel-default">
            	<div class="panel-heading">
            		<table>
            			<tr>
            				<td><b>From </b></td>
            				<td>
            					<input type="text" name="from" id="from" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" style="width: 50%;">
            				</td>
            				<!-- <td style="width: 5%;"></td> -->
            				<td><b>To </b></td>
            				<td>
            					<input type="text" name="to" id="to" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" style="width: 50%; margin-left: 5%;">
            				</td>
            			</tr>
            		</table>
            	</div>
            	<div class="panel-body" style="padding-bottom: 4px;">
            		<!-- <button onClick="changeData()">Change Data</button> -->
                	<label for="sel1">Select customer (select one)</label>
			      	<select class="form-control" id="sel1" style="width: 20%;">
			      		<option></option>
			      		@foreach($customer as $value)
			        		<option value="{{ $value->id }}">{{ $value->name }}</option>
			        	@endforeach
			      	</select>
                	<div class="chart" id="chart">
                		
                	</div>
            	</div>
            	<div class="show-report-info" style="margin-top: 2%;">
            		
            	</div>
            	
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>



@endsection

@section('script')


<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="js/donut3D/Donut3D.js"></script>
<script>

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

	// var salesData=[
	// 	{label:"Basic", color:"#3366CC"},
	// 	{label:"Plus", color:"#DC3912"},
	// 	{label:"Lite", color:"#FF9900"},
	// 	{label:"Elite", color:"#109618"},
	// 	{label:"Delux", color:"#990099"}
	// ];

	var y = 150;
	var svg = d3.select(".chart").append("svg").attr("width",700).attr("height",800);

	svg.append("g").attr("id","salesDonut");
	svg.append("g").attr("id","quotesDonut");
	svg.append("g").attr("id","a");

    $("#sel1").change(function(){
    	var data2 = [];
    	var temp = [];
    	var datatest = [];
        var e = document.getElementById("sel1");
		var id = e.options[e.selectedIndex].value;
		var name = e.options[e.selectedIndex].text;
		var from = $('#from').val();
  		var to = $('#to').val();
		// alert(from + "    " + to)

		$.ajax({
			type : 'get',
			url : 'admin/report_chart/getchart',
			data : {'id':id,'from':from,'to':to},
			success:function(data){
				// console.log(data)

				data.forEach(function(element) {
					var project_id = element.project_id;
				    console.log(element.project_id + '  ' + element.lastname + '  ' + element.time);
				    temp.push(element.time);
				});

				var label = ["Basic","Plus","Lite","Elite","Delux","Will","Philippe"];
				var color = ["#3366CC","#DC3912","#FF9900","#109618","#990099","#66b3ff","#ff1a75"]
				
				for(var i=0; i<temp.length; i++)  {
				    data2.push({label: label[i], value: temp[i], color: color[i]});
				}
				console.log(data2)

				Donut3D.draw("salesDonut", randomData(), 150, y, 130, 100, 30, 0.4);
				// Donut3D.draw("quotesDonut", randomData(), 150, y+250, 130, 100, 30, 0);
				// Donut3D.draw("a", randomData(), 150, y+500, 130, 100, 30, 0);

				function randomData(){
				
					return data2.map(function(d){ 
						return {label:d.label, value:d.value, color:d.color};});
						// return {label:d.label, value:getData(), color:d.color};});
				}
				

				var x = document.getElementById("chart");

				if(id){
					if(data2.length > 0){
						x.style.display = "block";
						Donut3D.transition("salesDonut", randomData(), 130, 100, 30, 0.4);
						// Donut3D.transition("quotesDonut", randomData(), 130, 100, 30, 0);
						// Donut3D.transition("a", randomData(), 130, 100, 30, 0);
					}
					else{
						x.style.display = "none";
					}
				}
				else{
					x.style.display = "none";
				}
			}
		})
    });

</script>
	
@endsection
