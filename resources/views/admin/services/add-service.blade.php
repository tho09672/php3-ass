@extends('admin.layouts.main')
@php
$active='Service';
@endphp
@section('content')
<h1>Trang thêm mới service</h1>
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <label for="">Service name</label><br>
    <input type="text" name="name" id="" value="{{old('name')}}"><br>
    @error('name')
    <i style="color: red">{{ $message }}</i><br>
    @enderror
    <label for="">Chọn Icon: </label><br>
    <input type="file" name="iconUpload" id=""><br>
    @error('iconUpload')
    <i style="color: red">{{ $message }}</i><br>
    @enderror
    <button type="submit">add</button>
</form>
@endsection