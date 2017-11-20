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
                    <h1 class="page-header">Chart report
                        <small>Customers</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                	<!-- <button onClick="changeData()">Change Data</button> -->
                	<label for="sel1">Select customer (select one)</label>
			      	<select class="form-control" id="sel1" style="width: 30%;">
			      		<option></option>
			      		@foreach($customer as $value)
			        		<option value="{{ $value->id }}">{{ $value->name }}</option>
			        	@endforeach
			      	</select>
                	<div class="chart" id="chart">
                		
                	</div>
                        
                </div>
               
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>



@endsection

@section('script')


<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="js/donut3D/Donut3D.js"></script>
<script>

	// var salesData=[
	// 	{label:"Basic", color:"#3366CC"},
	// 	{label:"Plus", color:"#DC3912"},
	// 	{label:"Lite", color:"#FF9900"},
	// 	{label:"Elite", color:"#109618"},
	// 	{label:"Delux", color:"#990099"}
	// ];

	var svg = d3.select(".chart").append("svg").attr("width",700).attr("height",800);

	svg.append("g").attr("id","salesDonut");
	svg.append("g").attr("id","quotesDonut");
	svg.append("g").attr("id","a");


	Donut3D.draw("salesDonut", randomData(), 150, 150, 130, 100, 30, 0.4);
	Donut3D.draw("quotesDonut", randomData(), 150, 400, 130, 100, 30, 0);
	Donut3D.draw("a", randomData(), 150, 650, 130, 100, 30, 0);


    $("#sel1").change(function(){
        var e = document.getElementById("sel1");
		var id = e.options[e.selectedIndex].value;
		var name = e.options[e.selectedIndex].text;
		// alert(id + "    " + name)

		var x = document.getElementById("chart");

		if(id){
			x.style.display = "block";
			Donut3D.transition("salesDonut", randomData(), 130, 100, 30, 0.4);
			Donut3D.transition("quotesDonut", randomData(), 130, 100, 30, 0);
			Donut3D.transition("a", randomData(), 130, 100, 30, 0);
		}
		else{
			x.style.display = "none";
		}
    });
		
	// function changeData(){
	// 	Donut3D.transition("salesDonut", randomData(), 130, 100, 30, 0.4);
	// 	Donut3D.transition("quotesDonut", randomData(), 130, 100, 30, 0);
	// }

	function randomData(){
		
		var salesData=[
			{label:"Basic", value:1 ,color:"#3366CC"},
			{label:"Plus", value:2 , color:"#DC3912"},
			{label:"Lite", value:3 , color:"#FF9900"},
			{label:"Elite", value:25 , color:"#109618"},
			{label:"Delux", value:15 , color:"#990099"}
		];

		return salesData.map(function(d){ 
			return {label:d.label, value:1000*Math.random(), color:d.color};});
			// return {label:d.label, value:d.value, color:d.color};});
	}
</script>

	
@endsection
