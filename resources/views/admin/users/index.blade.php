@extends('admin.layouts.main')

@php
$active='User';
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
        <th>email</th>
        <th>phone</th>
        <th>avata</th>
        <th>role</th>
        <th>
        <a href="{{route('user.add')}}" class="btn btn-primary">Add-user</a>
        </th>
    </tr>
    @foreach($users as $u)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$u->name}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->phone}}</td>
        <td>
        <img src="{{asset('storage/'.$u->avata)}}" alt="" width="100">
        </td>
        <td>
            <ul>
                @foreach($roles as $r)

                @if($u->hasRole($r))
                <li>{{$r->name}}</li>
                @endif

                @endforeach
            </ul>
        </td>
        <td>
            <a class="btn btn-sm btn-success" href="{{route('user.edit',['id'=>$u->id])}}">Update</a>
            <a class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa user này')" href="{{route('user.remove',['id'=>$u->id])}}">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection