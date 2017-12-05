@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Customers
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/customer/edit/{{$customer->id}}" method="POST" id="edit_customer">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{$customer->name}}" placeholder="Please enter employee type" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" value="{{$customer->email}}" placeholder="Please enter employee type" readonly="" />
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" name="city" value="{{$customer->city}}" placeholder="Please enter employee type" />
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input class="form-control" name="country" value="{{$customer->country}}" placeholder="Please enter employee type" />
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
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
       
<!-- /#page-wrapper -->	

@endsection

@section('script')
    <!-- <script src="../resources/views/error/error.js"></script> -->
    <script src="{{asset('js/error/error.js')}}"></script>
@endsection
