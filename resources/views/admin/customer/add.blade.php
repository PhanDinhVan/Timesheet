@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Customers
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger" id="error">
                            @foreach($errors->all() as $err)
                                {{$err}} <br>
                                @break
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success customer_fr">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <form action="admin/customer/add" method="POST" id="add_customer">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <div class="form-group start_date_fr">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Please enter company name" />
                        </div>
                        <div class="form-group end_date_fr">
                            <label>Contact</label>
                            <input class="form-control" name="contact" placeholder="Please enter contact name" />
                        </div>
                        <div class="form-group start_date_fr">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Please enter customer email" />
                        </div>
                        <div class="form-group end_date_fr">
                            <label>City</label>
                            <input class="form-control" name="city" placeholder="Please enter customer city" />
                        </div>
                        <div class="form-group customer_fr">
                            <label>Country</label>
                            <input class="form-control" name="country" id="country" type="hidden" />
                            <select class="form-control selectpicker countrypicker" data-live-search="true" data-flag="true" id="dropDown_select">
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default" id="target">Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <a class="btn btn-default btn-close" href="{{ URL::to('admin/customer/list') }}">Cancel</a>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@include('error.messages')
<!-- /#page-wrapper -->	

@endsection


@section('script')
    <script src="js/countrypicker.js"></script>
    <script src="{{asset('js/error/error.js')}}"></script>
    <!-- <script src="{{asset('../resources/views/error/error.js')}}"></script> -->
    <script src="admin_asset/sweetalert/dist/sweetalert.min.js"></script>
@endsection


