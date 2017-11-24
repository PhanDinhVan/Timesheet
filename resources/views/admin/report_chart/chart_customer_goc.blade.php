@extends('admin.layout.index')
@section('content')

<style>
	.chart {
	  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	  width: 30%;
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
	label{
	    float: left;
	    margin-right: 1%;
	    margin-top: 0.5%;
	}
	#sel1{
		width: 20%;
		float: left;
	}
	button{
		margin-left: 5%;
	}
	.date{
		width: 50%; 
		margin-left: 5%;
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
            					<input type="text" name="from" id="from" class="form-control date" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}">
            				</td>
            				<!-- <td style="width: 5%;"></td> -->
            				<td><b>To </b></td>
            				<td>
            					<input type="text" name="to" id="to" class="form-control date" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}">
            				</td>
            			</tr>
            		</table>
            	</div>
            	<div class="panel-body" style="padding-bottom: 4px;">
            		
                	<label>Select customer</label>
			      	<select class="form-control" id="sel1">
			      		<option></option>
			      		@foreach($customer as $value)
			        		<option value="{{ $value->id }}">{{ $value->name }}</option>
			        	@endforeach
			      	</select>
			      	<button onClick="changeData()" class="btn btn-info">Go <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
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
	var width = 400;
	var height = 850;

	function changeData(){
		$('#chart svg').remove();
    	var svg = d3.select(".chart").append("svg").attr("width",width).attr("height",height);

		svg.append("g").attr("id","salesDonut1");
		svg.append("g").attr("id","salesDonut2");
		svg.append("g").attr("id","salesDonut3");
		svg.append("g").attr("id","salesDonut4");
		svg.append("g").attr("id","salesDonut5");
		svg.append("g").attr("id","salesDonut6");
		svg.append("g").attr("id","quotesDonut");

		var data2 = [];
    	var datatest = [];
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
  		// use get list last name (a1,c1,will1)
  		var a1;
  		var c1 = [];
  		var will1 = [];
  		var count = 0;
  		var value_count;
		// alert(from + "    " + to)

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

					    if(project_id == project_temp){
					    	// alert(project_id+'hay lam'+project_temp)
					    	will.push(element.time);
					    	will1.push(element.lastname);
					    }
					    else{
					    	if(will.length == 0){
					    		// alert('lan dau')
					    		project_temp = project_id;
					    		will.push(element.time);
					    		will1.push(element.lastname);
					    	}
					    	else{
					    		count++;
					    		// console.log(will)
					    		a = will;
					    		a1 = will1;
					    		c.push(will);
					    		c1.push(will1);
					    		will = [];
					    		will1 = [];
						    	// alert('lan sau'+project_id+'khac'+project_temp)
						    	project_temp = project_id;  
						    	will.push(element.time);
						    	will1.push(element.lastname);
					    	}
					    }
					});

					// chart of customer have many project
					for(var k = 0; k < c.length; k++){
						var b = c[k];
						var label = c1[k];
						// console.log(b)

						// var label = ["Basic","Plus","Lite","Elite","Delux","Will","Philippe"];
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

						Donut3D.draw("salesDonut1", randomData(), 150, y, 130, 100, 30, 0);
						Donut3D.draw("salesDonut2", randomData(), 150, y, 130, 100, 30, 0);
						Donut3D.draw("salesDonut3", randomData(), 150, y, 130, 100, 30, 0);
						Donut3D.draw("salesDonut4", randomData(), 150, y, 130, 100, 30, 0);
						Donut3D.draw("salesDonut5", randomData(), 150, y, 130, 100, 30, 0);
						Donut3D.draw("salesDonut6", randomData(), 150, y, 130, 100, 30, 0);
						y = y + 250;
						value_count = y;

						var x = document.getElementById("chart");

						if(id){
							if(data2.length > 0){
								var i = 1;
								x.style.display = "block";
								Donut3D.transition("salesDonut"+i, randomData(), 130, 100, 30, 0);
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
					// var label = ["Basic","Plus","Lite","Elite","Delux","Will","Philippe"];
					var color = ["#3366CC","#DC3912","#FF9900","#109618","#990099","#66b3ff","#ff1a75"];
					// console.log(will)
					if(will){
						for(var i=0; i<will.length; i++)  {
						    data2.push({label: will1[i], value: will[i], color: color[i]});
						}
						
						Donut3D.draw("quotesDonut", randomData(), 150, z, 130, 100, 30, 0);
					}

					var x = document.getElementById("chart");

						if(id){
							if(data2.length > 0){
								x.style.display = "block";
								Donut3D.transition("quotesDonut", randomData(), 130, 100, 30, 0);
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
		else{
			alert("Please select customer name!");
		}
	}

</script>
	
@endsection
