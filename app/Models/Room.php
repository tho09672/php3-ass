<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table='rooms';
    public $fillable=['room_no','floor','price','detail'];
    public function services()
    {
     return $this->belongsToMany(Service::class, 'room_services', 'room_id', 'service_id')
                    ->withPivot('additional_price');
    }
    // public function roomSerrvice()
    // {
    //    return $this->hasMany(RoomService::class,'room_id');
    // }
}
