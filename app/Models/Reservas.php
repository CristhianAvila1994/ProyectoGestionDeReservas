<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function habitacione()
    {
        return $this->belongsTo(Habitacione::class,'Habitacion_id','id');
    }

    public function huespede()
    {
        return $this->belongsTo(Huespede::class,'Huespedes_id','id');
    }
}
