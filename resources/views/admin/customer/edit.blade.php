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
            <h2 class="m-t-0 header-titles"> <b>edit customer</b></h2>
            <form action="admin/customer/edit/{{$customer->id}}" method="POST" id="edit_customer">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Company Name</label>
                        <input class="form-control" name="name" value="{{$customer->name}}" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Industry</label>
                        <input class="form-control" name="industry" value="{{$customer->industry}}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Contact Name</label>
                        <input class="form-control" name="contact" value="{{$customer->contact}}" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" name="email" value="{{$customer->email}}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Country</label>
                        <input class="form-control" name="country" value="{{$customer->country}}" id="country_edit" type="hidden" />
                        <select class="form-control selectpicker countrypicker" data-live-search="true" data-flag="true" data-default="{{$customer->country}}" id="dropDown_select_edit">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">City</label>
                        <input class="form-control" name="city" value="{{$customer->city}}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('edit_customer').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add" id="target_edit">Save</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/customer/list') }}">Cancel</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->	

@endsection

@section('script')
    <!-- <script src="../resources/views/error/error.js"></script> -->
    <script src="{{asset('js/error/error.js')}}"></script>
    <script src="js/countrypicker.js"></script>
    <script src="admin_asset/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        
    </script>
@endsection
