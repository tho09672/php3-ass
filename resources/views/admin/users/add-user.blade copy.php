@extends('admin.layouts.main')

@php
$active='User';
@endphp

@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <label for="">name:</label><br>
    <input type="text" name="name" id="" value="{{old('name')}}"><br>
    @error('name')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">email:</label><br>
    <input type="email" name="email" id="" value="{{old('email')}}"><br>
    @error('email')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">password:</label><br>
    <input type="password" name="password" id=""><br>
    @error('password')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">phone:</label><br>
    <input type="text" name="phone" id="" value="{{old('phone')}}"><br>
    @error('phone')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">vai trò:</label><br>
    <div>
        @foreach($roles as $r)
        <input type="checkbox" name="role[]" @if(is_array(old('role')) && in_array($r->name,old('role'))) checked @endif value="{{$r->name}}">
        <label for="">{{$r->name}}</label>
        @endforeach
    </div>
    <label for="">avata:</label><br>
    @error('avataUpload')
    <i style="color: red;">{{$message}}</i><br>
    @enderror 
    <input type="file" name="avataUpload" id=""><br>
    <button type="submit">add</button>
</form>
@endsection