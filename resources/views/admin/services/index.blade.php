@extends('admin.layouts.main')
@php
$active='Service';
@endphp
@section('pagejs')
@if(session('msg'))
<script>
alert('{{session("msg")}}')
</script>
@endif
@endsection
@section('content')
<h1 class="">trang quản trị serveice</h1>
<table class="table table-bordered" border="">
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Icon</th>
            <th>
                <a href="{{route('service.add')}}">Add-servide</a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $s)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$s->name}}</td>
            <td>
                 <img src="{{asset( 'storage/' . $s->icon)}}" width="20" />
            </td>
            <td>
                <a href="{{route('service.edit',['id'=>$s->id])}}">update</a>
                <a onclick="return confirm('Bạn muốn xóa')" href="{{route('service.remove',['id'=>$s->id])}}">delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection