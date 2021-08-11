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
<form action="" method="post">
    @csrf
    <label for="">Tên vai trò</label><br>
    <input type="text" name="name" id="" value="{{$errors->any()?old('name'):$role->name}}"><br>
    @error('name')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">Cấp quyền</label><br>
    <div>
    @foreach($pers as $p)
    <input type="checkbox" @if($role->hasPermissionTo($p)) checked @endif name="permission[]" id="" value="{{$p->name}}">
    <label for="">{{$p->name}}</label>
    @endforeach
    </div>
    <button type="submit">updateRole</button>
</form>
@endsection