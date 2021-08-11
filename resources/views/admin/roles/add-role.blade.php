@extends('admin.layouts.main')

@php
$active='Role';
@endphp

@section('content')
<form action="" method="post">
    @csrf
    <label for="">Tên vai trò</label><br>
    <input type="text" name="name" id="" value="{{old('name')}}"><br>
    @error('name')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">Cấp quyền</label><br>
    <div>
    @foreach($pers as $p)
    <input type="checkbox" name="permission[]" id="" value="{{$p->name}}">
    <label for="">{{$p->name}}</label>
    @endforeach
    </div>
    <button type="submit">addRole</button>
</form>
@endsection