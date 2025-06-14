<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nota' => $this->nota,
            'comentario' => $this->comentario,
            'usuario' => new UsuarioResource($this->whenLoaded('usuario')),
            'livro' => new LivroResource($this->whenLoaded('livro')),
        ];
    }
}
