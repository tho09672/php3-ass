<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomFormRequest;
use App\Models\Room;
use App\Models\RoomService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $pageSize=2;
        $data_searchs=$request->all();
        $rooms = Room::paginate($pageSize);
        $floors=[];
        foreach($rooms as $r){
            $floors[]=$r->floor; 
        }
        $floors=array_unique( $floors);
        sort($floors);
        if(count($request->all())>0){
            $rooms = Room::all();
            $roomQuery=Room::where('room_no','like',"%$request->keyword%");
            if($request->floor>0){
                $roomQuery->where('floor',$request->floor);
            }
            if($request->order_by>0){
                if($request->order_by == 1){
                    $roomQuery->orderBy('price');
                }else{

                    $roomQuery->orderByDesc('price');
                }
            }
            $rooms= $roomQuery->paginate($pageSize)->withQueryString();
            $data_search=$request->all();
        }
       
        $rooms->load('services');
        return view('admin.rooms.index', compact('floors','data_searchs','rooms'));
    }
    public function addRoom()
    {
        $services = Service::all();
        return view('admin.rooms.add-room', ['services' => $services]);
    }
    public function saveRoom(RoomFormRequest $request)
    {
        # insert cho room
        $room = new Room();
        $room->fill($request->all());
        if ($request->hasFile('imageUpload')) {
            $path = $request->file('imageUpload')->store('public/uploads/rooms');
            $room->image = str_replace('public/', '', $path);
        }
        $room->save();
        # insert cho room-service
        if ($request->has('service_id')) {
            foreach ($request->service_id as $sv) {
                $service = new RoomService();
                $service->room_id = $room->id;
                $service->service_id = $sv;
                $service->additional_price = $request->additional_price;
                $service->save();
            }
        }
        return redirect(route('room.index'))->with('msg', 'Thêm mới thành công');
    }
    public function editRoom($id)
    {

        $room = Room::find($id);
        if(!$room){
            return redirect()->back()->with('msg','sản phẩm không tồn tại');
        }
        $services = Service::all();
        $arrServices = [];
        $room->load('services');
        foreach ($room->services as $sv) {
            $arrServices[] = $sv->id;
        }
        return view('admin.rooms.edit-room', ['services' => $services, 'room' => $room, 'arrServices' => $arrServices]);
    }
    public function updateRoom(RoomFormRequest $request, $id)
    {
        $room = Room::find($id);
        if(!$room){
            return redirect()->back()->with('msg','sản phẩm không tồn tại');
        }
        $room->fill($request->all());
        if ($request->hasFile('imageUpload')) {
            $path = $request->file('imageUpload')->store('public/uploads/rooms');
            $room->image = str_replace('public/', '', $path);
            $path_old = storage_path().'/app/public/'.$request->image;
            if(File::exists($path_old)){
                unlink($path_old);
            }
        } else {
            $room->image = $request->image;
        }
        $room->save();
        # insert cho room-service

        if ($request->has('service_id')) {
            foreach ($room->services as $rs) {
                $rs->pivot->delete();
            }
            foreach ($request->service_id as $sv) {
                $service = new RoomService();
                $service->room_id = $id;
                $service->service_id = $sv;
                $service->additional_price = $request->additional_price;
                $service->save();
            }
            # có thể xử lý theo cách khác
            # kiểm tra mảng service_id gửi lên và mảng service_id trong bảng room_service
            # những id có trong service_id gửi lên mà không có trong mảng service_id trong bảng room_service thì tiến hành thêm vào
            # những id có trong mảng service_id trong bảng room_service mà không có trong mảng service_id gửi lên thì xóa đi
        } else {
            foreach ($room->services as $rs) {
                $rs->pivot->delete();
            }
        }
        return redirect(route('room.edit',['id'=>$id]))->with('msg','cập nhật sản phẩm thành công');
    }
    public function removeRoom($id)
    {
        $room=Room::find($id);
        if(!$room){
            return redirect()->back()->with('msg','sản phẩm không tồn tại');
        }
        $room->delete();
        $path_old=storage_path().'/app/public/'.$room->image;
        if(File::exists($path_old)){
            unlink($path_old);
        }
        return redirect()->back()->with('msg','xóa sản phẩm thành công');;
    }
}
