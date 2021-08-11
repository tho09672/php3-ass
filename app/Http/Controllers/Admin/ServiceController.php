<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceFormRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', ['services' => $services]);
    }
    public function addService()
    {
        return view('admin.services.add-service');
    }
    public function saveService(ServiceFormRequest $request)
    {
        $service = new Service();
        $service->name = $request->name;
        if ($request->hasFile('iconUpload')) {
            $path = $request->file('iconUpload')->store('public/uploads/services');
            $service->icon = str_replace('public/', '', $path);
        }
        $service->save();
        return redirect()->route('service.index')->with('msg', 'Thêm mới thành công');
    }
    public function editService($id)
    {
            $service = Service::find($id);
            return view('admin.services.edit-service', ['service' => $service]);
        }
    public function updateService(ServiceFormRequest $request, $id)
    {
        $service = Service::find($id);
        $service->name = $request->name;
        if ($request->hasFile('iconUpload')) {
            $path = $request->file('iconUpload')->store('public/uploads/services');
            $service->icon = str_replace('public/', '', $path);
            $path = storage_path().'/app/public/'.$request->iconOld;
                if(File::exists($path)){
                    unlink($path);
                }
        } else {
            $service->icon = $request->iconOld;
        }
        $service->save();
        return redirect()->route('service.edit', ['id' => $id])->with('msg', 'cập nhật thành công');
    }
    public function removeService($id)
    {
        $service=Service::find($id);
        $service->delete();
        $path=storage_path().'/app/public/'.$service->icon;
        if(File::exists($path)){
            unlink($path);
        }
        return redirect()->back();
    }
}
