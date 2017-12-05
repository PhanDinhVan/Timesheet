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
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/customer/add" method="POST" id="add_customer">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Please enter customer name" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Please enter customer email" />
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" name="city" placeholder="Please enter customer city" />
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input class="form-control" name="country" placeholder="Please enter customer country" />
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
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
    <script src="{{asset('js/error/error.js')}}"></script>
    <!-- <script src="{{asset('../resources/views/error/error.js')}}"></script> -->

    <!-- check email is exits -->
    <script type="text/javascript">
        // var err = document.getElementById('error').innerText;
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'email_exits') {
                $('#email_exits').modal('show');
            }
        }
    </script>
    
@endsection


