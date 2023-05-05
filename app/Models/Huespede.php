<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huespede extends Model
{
    use HasFactory;
    protected $table = 'huespedes';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function reservas()
    {
        return $this->hasMany(Reservas::class,'Huespedes_id','id');
    }
}
