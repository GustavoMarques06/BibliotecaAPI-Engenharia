<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'generos';
    protected $fillable = ['nome'];
   
    public function livros()
    {
        return $this->hasMany(\App\Models\Livro::class, 'genero_id');
    }
}