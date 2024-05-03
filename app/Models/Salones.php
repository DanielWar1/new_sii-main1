<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salones extends Model
{
    use HasFactory;

    protected $table = 'salones';

    protected $fillable = [
        'nombre_salon',
        'edificios_id',
    ];
    
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    public function edificio() {
        return $this->belongsTo(Edificio::class);
    }
}