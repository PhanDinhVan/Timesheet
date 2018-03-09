@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            @if(count($errors) > 0)
                <div class="alert alert-danger errors" id="error">
                    @foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                </div>
            @endif
            <h2 class="m-t-0 header-titles"> <b>new customer</b></h2>
            <form action="admin/customer/add" method="POST" id="add_customer">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Company Name</label>
                        <input class="form-control" name="name" placeholder="Please enter company name" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Industry</label>
                        <input class="form-control" name="industry" placeholder="Please enter industry " />
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Contact Name</label>
                        <input class="form-control" name="contact" placeholder="Please enter contact name" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" name="email" placeholder="Please enter customer email" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Country</label>
                        <input class="form-control" name="country" id="country" type="hidden" />
                        <select class="form-control selectpicker countrypicker" data-live-search="true" data-flag="true" id="dropDown_select">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">City</label>
                        <input class="form-control" name="city" placeholder="City" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('add_customer').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add" id="target">Add</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/customer/list') }}">Cancel</a>
                    </div>
                </div>
                
            </form>
        </div>
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


