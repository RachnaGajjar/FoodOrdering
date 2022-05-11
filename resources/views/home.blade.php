@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Admin</a></li>
    <li class="breadcrumb-item">Dashboard</li>
</ol>
@if(Auth::user()->role == 'Admin')
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">

                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    {!! $customer !!}
                    <small class="m-0 l-h-n"><a href="#" style="color: white;"> Number of customer </a> </small>
                </h3>
            </div>
            <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    Orders
                    <small class="m-0 l-h-n"><a href="" style="color: white;"> Number of Orders </a> </small>
                </h3>
            </div>
            <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    {!! $Restaurant !!}
                    <small class="m-0 l-h-n"><a href="" style="color: white;"> Number of Restaurant </a> </small>
                </h3>
            </div>
            <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
        </div>
    </div>
<div class="col-sm-6 col-xl-3">
    <div class="p-3 bg-primary-200 rounded overflow-hidden position-relative text-white mb-g">
        <div class="">
            <h3 class="display-4 d-block l-h-n m-0 fw-500">
                {!! $fooditems !!}
                <small class="m-0 l-h-n"><a href="" style="color: white;"> Number of Fooditems </a> </small>
            </h3>
        </div>
        <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
    </div>
</div>
@endif
@if(Auth::user()->role == 'Owner')
<div class="row">

    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    {!! $product !!}
                    <small class="m-0 l-h-n"><a href="" style="color: white;"> Number of Products </a> </small>
                </h3>
            </div>
            <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    Orders
                    <small class="m-0 l-h-n"><a href="" style="color: white;"> Number of Orders </a> </small>
                </h3>
            </div>
            <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
        </div>
    </div>

</div>
@endif

@endsection
