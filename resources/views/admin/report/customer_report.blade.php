@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h2 class="m-t-0 m-b-20 header-titles"><b>Customer Report</b> </h2>
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
                                    <select multiple="multiple" class="multi-select" id="framework" name="my_multi_select1[]" data-plugin="multiselect">
                                        @foreach($customer as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class=" col-md-3 offset-md-3">
                                    <button type="button" class="btn btn-info" id="searchCustomer" onclick="search_Customer()">
                                        <span class="glyphicon glyphicon-search"></span> Search
                                    </button>
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>

            <div class="table-responsive">
    
            </div>
        </div>
    </div>
</div>
    
@include('error.messages')
       
<!-- /#page-wrapper --> 

@endsection

@section('script')
	<script  type="text/javascript">

		// ============= from ================
		$('#from').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd',
      autoclose: true
		});

		// =============== to ===============
		$('#to').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd',
      autoclose: true
		});


		$(document).ready(function(){
            $('#framework').multiSelect();

        });

		function search_Customer(from,to,customer_id){
			var from = $('#from').val();
  		    var to = $('#to').val();
            var customer_id = $('#framework').val();
               //var count = customer_id.length;
              // alert(count)
              // alert('Value ID   '+customer_id);
              // console.log(customer_id);
              //console.log(count);
              
            if(customer_id != '' && customer_id !== null) {
                $.get("admin/report/showReportCustomer",{from:from,to:to,customer_id:customer_id}, function(data){
                    // console.log(data)
                    $('.table-responsive').html(data);
                });
            } else {
                // alert("Please select customer name!");
                $('#select_customer_name').modal('show');
            }
        }
	

	</script>
@endsection
