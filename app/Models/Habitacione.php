<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacione extends Model
{
    use HasFactory;
    protected $table = 'habitaciones';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function reservas()
    {
        return $this->hasMany(Reservas::class,'Habitacion_id','id');
    }
}
