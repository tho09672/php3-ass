@if(session('data')['msg'] != null)
<p style="color: red">{{session('data')['msg']}}</p>
@endif
<h2>Bạn cần xác nhận lại thông tin trước khi đổi MK</h2>
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
        <button type="submit">Xác nhận</button>
    </div>
</form>