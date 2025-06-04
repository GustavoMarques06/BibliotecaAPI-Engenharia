<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';
    protected $fillable = ['titulo', 'sinopse','autor_id','genero_id'];

    // Relaciona com Autor
    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    // Relaciona com Genero
    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    // Relaciona com Review
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class, 'livro_id');
    }
    protected static function booted()
    {
        static::deleting(function ($livro) {
            $livro->reviews()->delete();
        });
    }
}