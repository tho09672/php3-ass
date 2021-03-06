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
        return redirect(route('room.index'))->with('msg', 'Th??m m???i th??nh c??ng');
    }
    public function editRoom($id)
    {

        $room = Room::find($id);
        if(!$room){
            return redirect()->back()->with('msg','s???n ph???m kh??ng t???n t???i');
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
            return redirect()->back()->with('msg','s???n ph???m kh??ng t???n t???i');
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
            # c?? th??? x??? l?? theo c??ch kh??c
            # ki???m tra m???ng service_id g???i l??n v?? m???ng service_id trong b???ng room_service
            # nh???ng id c?? trong service_id g???i l??n m?? kh??ng c?? trong m???ng service_id trong b???ng room_service th?? ti???n h??nh th??m v??o
            # nh???ng id c?? trong m???ng service_id trong b???ng room_service m?? kh??ng c?? trong m???ng service_id g???i l??n th?? x??a ??i
        } else {
            foreach ($room->services as $rs) {
                $rs->pivot->delete();
            }
        }
        return redirect(route('room.edit',['id'=>$id]))->with('msg','c???p nh???t s???n ph???m th??nh c??ng');
    }
    public function removeRoom($id)
    {
        $room=Room::find($id);
        if(!$room){
            return redirect()->back()->with('msg','s???n ph???m kh??ng t???n t???i');
        }
        $room->delete();
        $path_old=storage_path().'/app/public/'.$room->image;
        if(File::exists($path_old)){
            unlink($path_old);
        }
        return redirect()->back()->with('msg','x??a s???n ph???m th??nh c??ng');;
    }
}
