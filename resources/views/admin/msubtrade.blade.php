<?php
if (Auth('admin')->User()->dashboard_style == "light") {
    $text = "dark";
} else {
    $text = "light";
}
?>
@extends('layouts.app')
    @section('content')
        @include('admin.topmenu')
        @include('admin.sidebar')
        <div class="main-panel bg-{{Auth('admin')->User()->dashboard_style}}">
            <div class="content">
                <div class="page-inner">
                    <div class="mt-2 mb-4">
                    <h1 class="title1 text-{{$text}}">Manage Subscription</h1>
                    </div>
                    @if(Session::has('message'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i> {{Session::get('message')}}
                            </div>
                        </div>
                    </div>
                    @endif
        
                    @if(count($errors) > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissable" role="alert" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                @foreach ($errors->all() as $error)
                                <i class="fa fa-warning"></i> {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                   
                    <div class="row mb-5">
                        <div class="col p-4 card shadow bg-{{Auth('admin')->User()->dashboard_style}}">
                            <div class="table-responsive" data-example-id="hoverable-table">
                                <table id="ShipTable" class="table table-hover text-{{$text}}"> 
                                    <thead> 
                                        <tr> 
                                            <th>USER</th>
                                            <th>MT4 ID</th>
                                            <th>MT4 Password</th>
                                            <th>Account Type</th>
                                            <th>Currency</th>
                                            <th>Leverage</th>
                                            <th>Server</th>
                                            <th>Duration</th>
                                            <th>Submitted at</th>
                                            <th>Started at</th>
                                            <th>Expiring at</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                    @foreach($subscriptions as $sub)
                                    <tr>
                                        <td>{{$sub->tuser->name}} {{$sub->tuser->l_name}}</td>
                                            <td>{{$sub->mt4_id}}</td>
                                            <td>{{$sub->mt4_password}}</td>
                                            <td>{{$sub->account_type}}</td>
                                            <td>{{$sub->currency}}</td>
                                            <td>{{$sub->leverage}}</td>
                                            <td>{{$sub->server}}</td>
                                            <td>{{$sub->duration}}</td>
                                            <td>{{\Carbon\Carbon::parse($sub->created_at)->toDayDateTimeString()}}</td>
                                            <td>{{\Carbon\Carbon::parse($sub->start_date)->toDayDateTimeString()}}</td>
                                            <td>{{\Carbon\Carbon::parse($sub->end_date)->toDayDateTimeString()}}</td>
                                            <td>{{$sub->status}}</td>
                                            <td>
                                                @if ($sub->status == "Pending")
												<a href="{{ url('admin/dashboard/confirmsub') }}/{{$sub->id}}" class="btn btn-primary btn-sm mb-2">Process</a>	
												@else
												<a class="btn btn-success btn-sm mb-2">Active</a>
                                                @endif
                                                <a href="{{ url('admin/dashboard/delsub') }}/{{$sub->id}}" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
    @endsection