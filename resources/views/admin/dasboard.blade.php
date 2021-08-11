@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$rooms}}</h3>

                <p>Room</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
                <!-- <i class="ion ion-bag"></i> -->
            </div>
            <a href="route('room.index')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$users}}</h3>

                <p>Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
                <!-- <i class="ion ion-stats-bars"></i> -->
            </div>
            <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$services}}</h3>

                <p>Service</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
                <!-- <i class="ion ion-person-add"></i> -->
            </div>
            <a href="{{route('service.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- <div class="col-lg-3 col-6"> -->
    <!-- small box -->
    <!-- <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div> -->
</div>
<!-- ./col -->
</div>
@endsection