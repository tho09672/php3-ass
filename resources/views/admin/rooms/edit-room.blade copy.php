@extends('admin.layouts.main')

@php
$active='Room';
@endphp
@section('pagejs')
@if(session('msg'))
<script>
    alert('{{session("msg")}}')
</script>
@endif
@endsection
@section('content')
<h1>Trang edit-room</h1>
<form action="{{route('room.update',['id'=>$room->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="">room_no:</label><br>
    <input type="text" name="room_no" id="" value="{{$errors->any()?old('room_no'):$room->room_no}}"><br>
    @error('room_no')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">floor:</label><br>
    <input type="number" name="floor" id="" value="{{$errors->any()?old('floor'):$room->floor}}"><br>
    @error('floor')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">image:</label><br>
    <img src="{{asset( 'storage/' . $room->image)}}" alt="" width="200"><br>
    <input type="hidden" name="image" value="{{$room->image}}">
    @error('imageUpload')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <input type="file" name="imageUpload" id=""><br>
    <label for="">price:</label><br>
    <input type="number" name="price" id="" value="{{$errors->any()?old('price'):$room->price}}"><br>
    @error('price')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">Chọn service:</label><br>
    @if($errors->any())
        @foreach($services as $s)
        <input type="checkbox" name="service_id[]" id="" @if(is_array(old('service_id')) && in_array($s->id,old('service_id'))) checked @endif value="{{$s->id}}"><label for="">{{$s->name}}</label>
        @endforeach
    @else
        @foreach($services as $s)
        <input type="checkbox" name="service_id[]" id="" {{in_array($s->id,$arrServices)?"checked":''}} value="{{$s->id}}"><label for="">{{$s->name}}</label>
        @endforeach
    @endif
    <br>
    <label for="">additional_price:</label><br>
    <input type="number" name="additional_price" @foreach($room->services as $s) value="{{$s->pivot->additional_price}}" @break @endforeach ><br>
    <label for="">detail:</label><br>
    <textarea name="detail" id="" cols="30" rows="3">{{$room->detail}}</textarea><br><br>
    <button type="submit">Update</button>
</form>
@endsection