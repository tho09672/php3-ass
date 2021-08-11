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
<form action="" method="post">
    @csrf
    <label for="">Tên quyền</label><br>
    <input type="text" name="name" value="{{$errors->any()?old('name'):$per->name}}"><br>
    @error('name')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <button type="submit">addPer</button>
</form>
@endsection
