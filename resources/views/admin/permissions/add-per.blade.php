@extends('admin.layouts.main')

@php
$active='Permission';
@endphp

@section('content')
<form action="" method="post">
    @csrf
    <label for="">Tên quyền</label><br>
    <input type="text" name="name" value="{{old('name')}}"><br>
    @error('name')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <button type="submit">addPer</button>
</form>
@endsection