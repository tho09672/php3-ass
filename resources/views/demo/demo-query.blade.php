<h1>Trang demo query</h1>
<table>
    <tr>
        <th>Stt</th>
        <th>id</th>
        <th>name</th>
    </tr>
    @foreach($service as $r)
    <tr>
        <th>{{$loop->iteration}}</th>
        <th>{{$r->id}}</th>
        <th>{{$r->name}}</th>
    </tr>
@endforeach
</table>