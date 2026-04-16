<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'correo',
        'career_id',
        'semestre'
    ];
    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
}