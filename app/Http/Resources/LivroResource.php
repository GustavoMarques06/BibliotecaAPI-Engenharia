<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'titulo'  => $this->titulo,
            'sinopse' => $this->sinopse,

            'autor' => [
                'id'   => $this->autor?->id,
                'nome' => $this->autor?->nome,
            ],

            'genero' => [
                'id'   => $this->genero?->id,
                'nome' => $this->genero?->nome,
            ],

            'reviews' => $this->reviews->map(function ($review) {
                return [
                    'id'         => $review->id,
                    'comentario' => $review->comentario,
                    'nota'       => $review->nota,
                ];
            }),
        ];
    }
}