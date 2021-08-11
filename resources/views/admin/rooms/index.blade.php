@extends('admin.layouts.main')

@php
$active='Room';
@endphp
@section('pagejs')
@if(session('msg'))
<script>
    alert('{{session("msg")}}')
</script>
@endif
@endsection
@section('content')
<form action="" method="get">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Chọn phòng</label>
                <input class="form-control" type="text" @isset($data_searchs['keyword']) value="{{$data_searchs['keyword']}}" @endisset name="keyword">
            </div>
            <div class="form-group">
                <label for="">Chọn tầng</label>
                <select class="form-control" name="floor">
                    <option value="0">Tất cả</option>
                    @foreach($floors as $f)
                    <!-- <option value="{{--$f--}}" {{--isset($data_searchs['floor']) && $data_searchs['floor']==$f ? 'selected' : ''--}}>Tầng {{--$f--}}</option> -->
                    <option value="{{$f}}" @if(isset($data_searchs['floor']) && $data_searchs['floor']==$f) selected @endif>Tầng {{$f}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Sắp xếp theo</label>
                <select class="form-control" name="order_by">
                    <option value="0">Mặc định</option>
                    <option value="1"  @if(isset($data_searchs['order_by']) && $data_searchs['order_by']==1) selected @endif>Giá tăng dần</option>
                    <option value="2"  @if(isset($data_searchs['order_by']) && $data_searchs['order_by']==2) selected @endif>Giá giảm dần</option>
                </select>
            </div>
            <div class="text-center">
                <br>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Room_no</th>
            <th>Floor</th>
            <th>Image</th>
            <th>Price</th>
            <th>Detail</th>
            <th>service</th>
            <th>additional_price</th>
            <th>
                <a class="btn btn-sm btn-primary" href="{{route('room.add')}}">Add-room</a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $r)
        <tr>
            <td>{{(($rooms->currentPage()-1)*$rooms->perPage())+$loop->iteration}}</td>
            <td>{{$r->room_no}}</td>
            <td>{{$r->floor}}</td>
            <td>
                <img src="{{asset( 'storage/' . $r->image)}}" width="100" />
            </td>
            <td>{{$r->price}}</td>
            <td>{{$r->detail}}</td>
            <td>
                <ul>
                    @foreach($r->services as $rs)
                    <li>{{$rs->name}}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                @foreach($r->services as $rs)
                {{$rs->pivot->additional_price}}
                @break
                @endforeach
            </td>
            <td>
                <a class="btn btn-sm btn-success"  href="{{route('room.edit',['id'=>$r->id])}}">Update</a>
                <a class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa')" href="{{route('room.remove',['id'=>$r->id])}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{$rooms->links()}}
</div>

@endsection