@extends('admin.layout.index')
@section('content')



<!-- Page Content --> 
    
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
            				<td>
            					<b>Period: </b>
            				</td>
            				<td>
            					start
            				</td>
            			</tr>
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
            		<p style="text-align: center;font-size: 20px;font-weight: bold;">Users Report</p>
            		
            		<form action="admin/report/showReport" method="post" id="framework_form">
					    <div class="form-group" style="width: 36%; float: left;">
					     	<label>Select </label>
					     	
					    	<select id="framework" name="framework[]" multiple class="form-control" >
					    		@foreach($customer as $value)
					      		<option value="{{$value->id}}">{{$value->name}}</option>
					      		@endforeach
					     	</select>
					     	
					    </div>
					    <div class="form-group">
					     	<!-- <input type="submit" class="btn btn-info" name="submit" value="Submit" /> -->
					     	<button type="button" class="btn btn-info" id="searchCustomer" onclick="search_Customer()">
						      	<span class="glyphicon glyphicon-search"></span> Search
						    </button>
					    </div>
					</form>
            	</div>
            	<div class="show-report-info" style="margin-top: 2%;">
            		
            	</div>
            	
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
       
<!-- /#page-wrapper --> 

@endsection

@section('script')
	<script  type="text/javascript">

		// ============= from ================
		$('#from').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd'
		});

		// $('#from').change(function () {
  //   		var from = $('#from').val();
  //   		var to = $('#to').val();
  //   		showTime(from,to)
		// });

		// =============== to ===============
		$('#to').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd'
		});

		// $('#to').change(function () {
  //   		var to = $('#to').val();
  //   		var from = $('#from').val();
  //   		showTime(from,to)
		// });

		// function showTime(from,to){
		// 	$.get("admin/report/showReport",{from:from,to:to}, function(data){
                
  //               // console.log(data)
  //               $('.show-report-info').html(data)
  //           });
		// }

		$(document).ready(function(){
		 	$('#framework').multiselect({
		  		nonSelectedText: 'Customer name',
		  		enableFiltering: true,
		  		enableCaseInsensitiveFiltering: true,
		 	 	buttonWidth:'300px'
		 	});
		});

		function search_Customer(from,to,customer_id){
			var from = $('#from').val();
  		var to = $('#to').val();
      var customer_id = $('#framework').val();
      // alert(customer_id);
      if(customer_id){

        $.get("admin/report/showReportCustomer",{from:from,to:to,customer_id:customer_id}, function(data){
            // console.log(data)
            $('.show-report-info').html(data)
        });
      }else{
        alert("Please select customer name!");
      }
		}

	</script>
@endsection
