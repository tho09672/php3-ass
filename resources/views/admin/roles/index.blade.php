@extends('admin.layouts.main')

@php
$active='Role';
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
        <th>permission</th>
        <th>
            <a href="{{route('role.add')}}" class="btn btn-primary">Add-role</a>
        </th>
    </tr>
    @foreach($roles as $r)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$r->name}}</td>
        <td>
            <ul>
                @foreach($pers as $p)

                @if($r->hasPermissionTo($p))
                <li>{{$p->name}}</li>
                @endif

                @endforeach
            </ul>
        </td>
        <td>
            <a href="{{route('role.edit',['id'=>$r->id])}}"  class="btn btn-sm btn-success">Update</a>
            <a onclick="return confirm('Bạn muốn xóa')" href="{{route('role.remove',['id'=>$r->id])}}" class="btn btn-sm btn-danger" >Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection