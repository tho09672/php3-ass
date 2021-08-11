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
<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update user</h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">name:</label>
                    <input type="text" name="name" value="{{$errors->any()?old('name'):$user->name}}" class="form-control" id="exampleInputEmail1">
                </div>
                @error('name')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
                <div class="form-group">
                    <label for="exampleInputEmail1">email:</label>
                    <input type="email" name="email" id="exampleInputEmail1" value="{{$errors->any()?old('email'):$user->email}}" class="form-control">
                </div>
                @error('email')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
                <div class="form-group">
                    <label for="exampleInputEmail1">phone:</label><br>
                    <input type="text" name="phone" id="exampleInputEmail1" value="{{$errors->any()?old('phone'):$user->phone}}" class="form-control">
                </div>
                @error('phone')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
                <div class="form-group">
                    <div>
                        <strong for="">Chọn dịch vụ</strong>
                    </div>
                    @if($errors->any())
                        @foreach($roles as $r)
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" name="role[]"  @if(is_array(old('role')) && in_array($r->name,old('role'))) checked @endif value="{{$r->name}}" class="form-check-input">{{$r->name}}
                            </label>
                        </div>
                        @endforeach
                    @else
                        @foreach($roles as $r)
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" name="role[]" @if($user->hasRole($r)) checked @endif value="{{$r->name}}" class="form-check-input">{{$r->name}}
                            </label>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">avata:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="avataUpload" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="avata" value="{{$user->avata}}">
                <img src="{{asset('storage/'.$user->avata)}}" alt="" width="100"><br>
                @error('avataUpload')
                <i style="color: red;">{{$message}}</i><br>
                @enderror
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection