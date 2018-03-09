@extends('admin.layout.index')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2 class="m-t-0 m-b-20 header-titles"><b>Chart Report Customer</b></h2>

            <div class="col-lg-7">
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}    
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="p-20">
                        <form class="form-horizontal">
                            
                            <div class="form-group row">
                                <div class="col-md-3 offset-md-3">
                                    <label class="col-form-label">From</label>
                                    <input type="text" name="from" id="from" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" >
                                </div>

                                <div class="col-md-3">
                                    <label class="col-form-label">To</label>
                                    <input type="text" name="to" id="to" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class=" col-md-6 offset-md-3">
                                    <label class="col-form-label">Select customer</label>
                                    <select class="form-control" id="select_customer">
                                        <option></option>
                                        @foreach($customer as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class=" col-md-3 offset-md-6">
                                    <button type="button" class="btn btn-info searchs" onclick="changeData_Customer()">
                                        Go <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            
                            
                        </form>

                    </div>
                </div>
            </div>

            <div class="show-report-info">

                <div class ="chart charts" id="chart"></div>
            </div>
                
        </div>
    </div>
</div>

@include('error.messages')

@endsection