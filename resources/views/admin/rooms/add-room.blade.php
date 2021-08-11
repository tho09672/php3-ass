@extends('admin.layouts.main')

@php
$active='Room';
@endphp
@section('content')

<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm mới room</h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Room_no:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="room_no" value="{{old('room_no')}}">
                </div>
                @error('room_no')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
                <div class="form-group">
                    <label for="exampleInputPassword1">Floor:</label>
                    <input type="number" name="floor" value="{{old('floor')}}" class="form-control" id="exampleInputPassword1">
                </div>
                @error('floor')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
                <div class="form-group">
                    <label for="exampleInputPassword1">Price:</label>
                    <input type="number" name="price" value="{{old('price')}}" class="form-control" id="exampleInputPassword1">
                </div>
                @error('price')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
                <div class="form-group">
                    <label for="exampleInputPassword1">Additional_price:</label>
                    <input type="number" name="additional_price" value="{{old('additional_price')}}" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <div>
                        <strong for="">Chọn dịch vụ</strong>
                    </div>
                    @foreach($services as $s)
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" name="service_id[]" 
                            @if(is_array(old('service_id')) && in_array($s->id,old('service_id'))) checked @endif value="{{$s->id}}"
                            class="form-check-input">{{$s->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Image:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="imageUpload" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                @error('imageUpload')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
                <div class="form-group">
                    <label>Detail:</label>
                    <textarea name="detail" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection