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
            		<button onClick="changeData()">Change Data</button>
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


	var y = 150;
	var z = 150;
	var svg = d3.select(".chart").append("svg").attr("width",700).attr("height",1500);

	svg.append("g").attr("id","salesDonut1");
	svg.append("g").attr("id","salesDonut2");
	svg.append("g").attr("id","quotesDonut");
	// svg.append("g").attr("id","a");

	function changeData(){
		$('#chart svg').remove();
    	var svg = d3.select(".chart").append("svg").attr("width",700).attr("height",850);

		svg.append("g").attr("id","salesDonut1");
		svg.append("g").attr("id","salesDonut2");
		svg.append("g").attr("id","quotesDonut");

		var data2 = [];
    	var data3 = [];
    	var datatest = [];
        var e = document.getElementById("sel1");
		var id = e.options[e.selectedIndex].value;
		var name = e.options[e.selectedIndex].text;
		var from = $('#from').val();
  		var to = $('#to').val();
  		var project_temp = 0;
  		var will = [];
  		var a;
  		var c = [];
  		var count = 0;
  		var value_count;
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

				    if(project_id == project_temp){
				    	// alert(project_id+'hay lam'+project_temp)
				    	will.push(element.time);
				    }
				    else{
				    	if(will.length == 0){
				    		// alert('lan dau')
				    		project_temp = project_id;
				    		will.push(element.time);
				    	}
				    	else{
				    		count++;
				    		// console.log(will)
				    		a = will;
				    		c.push(will);
				    		will = [];
					    	// alert('lan sau'+project_id+'khac'+project_temp)
					    	project_temp = project_id;  
					    	will.push(element.time);

				    	}
				    }
				});

				// chart of customer have many project
				for(var k = 0; k < c.length; k++){
					var b = c[k];
					// console.log(b)

					var label = ["Basic","Plus","Lite","Elite","Delux","Will","Philippe"];
					var color = ["#3366CC","#DC3912","#FF9900","#109618","#990099","#66b3ff","#ff1a75"];
					if(b){
						for(var i=0; i<b.length; i++)  {
						    data2.push({label: label[i], value: b[i], color: color[i]});
						}

					}
					else{
						for(var i=0; i<will.length; i++)  {
						    data2.push({label: label[i], value: will[i], color: color[i]});
						}
					}

					Donut3D.draw("salesDonut1", randomData(), 150, y, 130, 100, 30, 0.4);
					Donut3D.draw("salesDonut2", randomData(), 150, y, 130, 100, 30, 0.4);
					y = y + 250;
					value_count = y;

					var x = document.getElementById("chart");

					if(id){
						if(data2.length > 0){
							var i = 1;
							x.style.display = "block";
							Donut3D.transition("salesDonut"+i, randomData(), 130, 100, 30, 0.4);
							data2 = [];
							i++;
						}
						else{
							x.style.display = "none";
						}
					}
					else{
						x.style.display = "none";
					}
				}
				y = 150;
				// xet lai toa do y cua chart
				if(count > 0){
					z = value_count;
				}else{
					z = 150;
				}
				
				// chart of customer have 1 project or project last of customer have many project
				var label = ["Basic","Plus","Lite","Elite","Delux","Will","Philippe"];
				var color = ["#3366CC","#DC3912","#FF9900","#109618","#990099","#66b3ff","#ff1a75"];
				console.log(will)
				if(will){
					for(var i=0; i<will.length; i++)  {
					    data2.push({label: label[i], value: will[i], color: color[i]});
					}
					Donut3D.draw("quotesDonut", randomData(), 150, z, 130, 100, 30, 0.4);
				}

				var x = document.getElementById("chart");

					if(id){
						if(data2.length > 0){
							x.style.display = "block";
							Donut3D.transition("quotesDonut", randomData(), 130, 100, 30, 0.4);
							// Donut3D.transition("a", randomData(), 130, 100, 30, 0);
						}
						else{
							x.style.display = "none";
						}
					}
					else{
						x.style.display = "none";
					}

				function randomData(){
					return data2.map(function(d){ 
						return {label:d.label, value:d.value, color:d.color};});
						// return {label:d.label, value:getData(), color:d.color};});
				}

			}
		})
	}
  //   $("#sel1").change(function(){
  //   	$('#chart svg').remove();
  //   	var svg = d3.select(".chart").append("svg").attr("width",700).attr("height",850);

		// svg.append("g").attr("id","salesDonut1");
		// svg.append("g").attr("id","salesDonut2");
		// svg.append("g").attr("id","quotesDonut");
  //   	var data2 = [];
  //   	var data3 = [];
  //   	var datatest = [];
  //       var e = document.getElementById("sel1");
		// var id = e.options[e.selectedIndex].value;
		// var name = e.options[e.selectedIndex].text;
		// var from = $('#from').val();
  // 		var to = $('#to').val();
  // 		var project_temp = 0;
  // 		var will = [];
  // 		var a;
  // 		var c = [];
  // 		var count = 0;
  // 		var value_count;
		// // alert(from + "    " + to)

		// $.ajax({
		// 	type : 'get',
		// 	url : 'admin/report_chart/getchart',
		// 	data : {'id':id,'from':from,'to':to},
		// 	success:function(data){
		// 		// console.log(data)

		// 		data.forEach(function(element) {
		// 			var project_id = element.project_id;
		// 		    // console.log(element.project_id + '  ' + element.lastname + '  ' + element.time);

		// 		    if(project_id == project_temp){
		// 		    	// alert(project_id+'hay lam'+project_temp)
		// 		    	will.push(element.time);
		// 		    }
		// 		    else{
		// 		    	if(will.length == 0){
		// 		    		// alert('lan dau')
		// 		    		project_temp = project_id;
		// 		    		will.push(element.time);
		// 		    	}
		// 		    	else{
		// 		    		count++;
		// 		    		// console.log(will)
		// 		    		a = will;
		// 		    		c.push(will);
		// 		    		will = [];
		// 			    	// alert('lan sau'+project_id+'khac'+project_temp)
		// 			    	project_temp = project_id;  
		// 			    	will.push(element.time);

		// 		    	}
		// 		    }
		// 		});

		// 		// chart of customer have many project
		// 		for(var k = 0; k < c.length; k++){
		// 			var b = c[k];
		// 			// console.log(b)

		// 			var label = ["Basic","Plus","Lite","Elite","Delux","Will","Philippe"];
		// 			var color = ["#3366CC","#DC3912","#FF9900","#109618","#990099","#66b3ff","#ff1a75"];
		// 			if(b){
		// 				for(var i=0; i<b.length; i++)  {
		// 				    data2.push({label: label[i], value: b[i], color: color[i]});
		// 				}

		// 			}
		// 			else{
		// 				for(var i=0; i<will.length; i++)  {
		// 				    data2.push({label: label[i], value: will[i], color: color[i]});
		// 				}
		// 			}

		// 			Donut3D.draw("salesDonut1", randomData(), 150, y, 130, 100, 30, 0.4);
		// 			Donut3D.draw("salesDonut2", randomData(), 150, y, 130, 100, 30, 0.4);
		// 			y = y + 250;
		// 			value_count = y;

		// 			var x = document.getElementById("chart");

		// 			if(id){
		// 				if(data2.length > 0){
		// 					var i = 1;
		// 					x.style.display = "block";
		// 					Donut3D.transition("salesDonut"+i, randomData(), 130, 100, 30, 0.4);
		// 					data2 = [];
		// 					i++;
		// 				}
		// 				else{
		// 					x.style.display = "none";
		// 				}
		// 			}
		// 			else{
		// 				x.style.display = "none";
		// 			}
		// 		}
		// 		y = 150;
		// 		// xet lai toa do y cua chart
		// 		if(count > 0){
		// 			z = value_count;
		// 		}else{
		// 			z = 150;
		// 		}
				
		// 		// chart of customer have 1 project or project last of customer have many project
		// 		var label = ["Basic","Plus","Lite","Elite","Delux","Will","Philippe"];
		// 		var color = ["#3366CC","#DC3912","#FF9900","#109618","#990099","#66b3ff","#ff1a75"];
		// 		if(will){
		// 			for(var i=0; i<will.length; i++)  {
		// 			    data2.push({label: label[i], value: will[i], color: color[i]});
		// 			}
		// 			Donut3D.draw("quotesDonut", randomData(), 150, z, 130, 100, 30, 0.4);
		// 		}

		// 		var x = document.getElementById("chart");

		// 			if(id){
		// 				if(data2.length > 0){
		// 					x.style.display = "block";
		// 					Donut3D.transition("quotesDonut", randomData(), 130, 100, 30, 0.4);
		// 					// Donut3D.transition("a", randomData(), 130, 100, 30, 0);
		// 				}
		// 				else{
		// 					x.style.display = "none";
		// 				}
		// 			}
		// 			else{
		// 				x.style.display = "none";
		// 			}

		// 		function randomData(){
		// 			return data2.map(function(d){ 
		// 				return {label:d.label, value:d.value, color:d.color};});
		// 				// return {label:d.label, value:getData(), color:d.color};});
		// 		}

		// 	}
		// })
  //   });

</script>
	
@endsection
