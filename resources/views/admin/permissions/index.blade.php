@extends('admin.layouts.main')

@php
$active='Permission';
@endphp

@section('pagejs')
@if(session('msg')!=null)
<script>
    alert('{{session("msg")}}')
</script>
@endif
@endsection
@section('content')
<table class="table table-bordered">
    <tr>
        <th>stt</th>
        <th>name</th>
        <th>
            <a  class="btn btn-primary" href="{{route('per.add')}}">Add-per</a>
        </th>
    </tr>
    @foreach($pers as $p)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$p->name}}</td>
        <td>
            <a  class="btn btn-sm btn-success" href="{{route('per.edit',['id'=>$p->id])}}">sửa</a>
            <a  class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa')" href="{{route('per.remove',['id'=>$p->id])}}">xóa</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection