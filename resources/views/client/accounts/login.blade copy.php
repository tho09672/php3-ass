@if(session('data')['msg'] != null)
<p style="color: red">{{session('data')['msg']}}</p>
@else

@endif
<form action="" method="POST">
    @csrf
    <div>
        <label for="">Email</label>
        <input type="text" name="email" value="{{session('data')['form_data']}}">
        <br>
    </div>
    <div>
        <label for="">Password</label>
        <input type="password" name="password">
        <br>
    </div>
    <div>
        <button type="submit">Đăng nhập</button>
    </div>
</form>