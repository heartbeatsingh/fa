@extends('layouts.admin')
@section('dashboard','active')
@section('content')

<div class="row" style="margin-top: 50px;">
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="panel panel-white pricing-big" style="border: 1px solid #ccc !important;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-male fa-3x" style="color:green"></i> Male</h3>
            </div>
            <div class="panel-body no-padding text-align-center">
                <div class="">
                    <h1>
                        <strong>{{ $males ? $males : 0 }}</strong></h1>
                </div>

            </div>

        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="panel panel-white pricing-big" style="border: 1px solid #ccc !important;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-female fa-3x" style="color:red"></i> Female</h3>
            </div>
            <div class="panel-body no-padding text-align-center">
                <div class="">
                    <h1>
                        <strong>{{ $females ? $females : 0 }}</strong></h1>
                </div>

            </div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="panel panel-white pricing-big" style="border: 1px solid #ccc !important;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-users fa-3x" style="color:#F05F3E" ></i> Total Users</h3>
            </div>
            <div class="panel-body no-padding text-align-center">
                <div class="">
                    <h1><strong>{{ $totalmf ? $totalmf : 0 }}</strong></h1>
                </div>
            </div>

        </div>
    </div>


    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="panel panel-primary pricing-big" style="border: 1px solid #ccc !important;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="{{ url('/logout') }}"  title="Logout" data-action="userLogout" data-logout-msg="Are you sure you want to logout?"><i class="fa fa-sign-out fa-3x"></i></a></h3>
            </div>
            <div class="panel-body no-padding text-align-center">
                <div class="">
                    <h1>
                        <strong>Logout</strong></a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
