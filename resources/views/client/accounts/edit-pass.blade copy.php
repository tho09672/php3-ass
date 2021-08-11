@if(session('msg'))
<i style="color: red;">{{session('msg')}}</i>
@endif
<form action="" method="post">
    @csrf
    <label for="">Nhập mk mới</label><br>
    <input type="password" name="password" id="" value="{{--session('data')!=null?session('data')['password']:old('password')--}}"><br>
    @error('password')
    <i style="color: red;">{{$message}}</i><br>
    @enderror
    <label for="">Xác nhận mk</label><br>
    <input type="password" name="confirmPassword" id=""><br>
    <button type="submit">Lưu</button>
</form>