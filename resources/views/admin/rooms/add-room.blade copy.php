@extends('admin.layouts.main')

@php
$active='Room';
@endphp
@section('content')
<h1>Trang add-room</h1>
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <label for="">room_no:</label><br>
    <input type="text" name="room_no" id="" value="{{old('room_no')}}"><br>
    @error('room_no')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">floor:</label><br>
    <input type="number" name="floor" value="{{old('floor')}}"><br>
    @error('floor')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">image:</label><br>
    @error('imageUpload')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <input type="file" name="imageUpload" id=""><br>
    <label for="">price:</label><br>
    <input type="number" name="price" id="" value="{{old('price')}}"><br>
    @error('price')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">Chọn service:</label><br>
    @foreach($services as $s)
    <input type="checkbox" name="service_id[]" @if(is_array(old('service_id')) && in_array($s->id,old('service_id'))) checked @endif value="{{$s->id}}"><label for="">{{$s->name}}</label>
    @endforeach
    <br>
    <label for="">additional_price:</label><br>
    <input type="number" name="additional_price" id=""><br>
    <label for="">detail:</label><br>
    <textarea name="detail" id="" cols="30" rows="3"></textarea><br>
    <button type="submit">Lưu</button>
</form>
@endsection