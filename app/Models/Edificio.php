<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;
    protected $table ='edificios';
    protected $fillable = [
        'nombre_edificio',
        'descripcion',
    ];

    public $timestamps = false; #quita el timestampt default para modificar

    public function salones() {
        return $this->hasMany(Salones::class);
    }
}
