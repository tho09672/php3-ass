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
@section('content')
<h1>Trang edit Service</h1>
<form action="" method="post" enctype="multipart/form-data">
@csrf
    <label for="">service name</label><br>
    <input type="text" name="name" id="" value="{{$errors->any()?old('name'):$service->name}}"><br>
    @error('name')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">icon</label><br>
    <img src="{{asset( 'storage/' . $service->icon)}}" alt="" width="20"><br>
    <input type="hidden" name="iconOld" value="{{$service->icon}}">
    <input type="file" name="iconUpload" id=""><br>
    @error('iconUpload')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <button type="submit">add</button>
</form>
@endsection
