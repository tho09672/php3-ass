@extends('admin.layouts.main')

@php
$active='User';
@endphp

@section('pagejs')
@if(session('msg'))
<script>
alert('{{session("msg")}}')
</script>
@endif
@endsection

@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <label for="">name:</label><br>
    <input type="text" name="name" id="" value="{{$errors->any()?old('name'):$user->name}}"><br>
    @error('name')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">email:</label><br>
    <input type="email" name="email" id="" value="{{$errors->any()?old('email'):$user->email}}"><br>
    @error('email')
    <i style="color: red;">{{$message}}</i><br>
    @enderror<label for="">phone:</label><br>
    <input type="text" name="phone" id="" value="{{$errors->any()?old('phone'):$user->phone}}"><br>
    @error('phone')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">vai trò:</label><br>
    <div>
        @if($errors->any())
            @foreach($roles as $r)
            <input type="checkbox" name="role[]" @if(is_array(old('role')) && in_array($r->name,old('role'))) checked @endif value="{{$r->name}}">
            <label for="">{{$r->name}}</label>
            @endforeach
        @else
            @foreach($roles as $r)
            <input type="checkbox" name="role[]" @if($user->hasRole($r)) checked @endif value="{{$r->name}}">
            <label for="">{{$r->name}}</label>
            @endforeach
        @endif
    </div>
    <!-- <input type="hidden" name="password" value="123456"> -->
    <!-- tạo password để pass qua validate, giá trị này sẽ không được update vào db  -->
    <label for="">avata:</label><br>
    <input type="hidden" name="avata" value="{{$user->avata}}">
    <img src="{{asset('storage/'.$user->avata)}}" alt="" width="100"><br>
    @error('avataUpload')
    <i style="color: red;">{{$message}}</i><br>
    @enderror 
    <input type="file" name="avataUpload" id=""><br>
    <button type="submit">updateUser</button>
</form>
@endsection