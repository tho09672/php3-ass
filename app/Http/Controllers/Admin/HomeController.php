<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users=count(User::all());
        $rooms=count(Room::all());
        $services=count(Service::all());

        return view('admin.dasboard', compact('users','rooms','services'));
    }
}
