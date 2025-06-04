<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nome', 'email', 'senha'];
    
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class, 'usuario_id');
    }
    protected static function booted()
    {
        static::deleting(function ($usuario) {
            $usuario->reviews()->delete();
        });
    }
}
 