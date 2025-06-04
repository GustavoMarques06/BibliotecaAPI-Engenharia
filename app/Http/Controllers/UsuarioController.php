<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Resources\UsuarioResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuarioController extends Controller
{
    public function __construct(private UsuarioService $usuarioService) 
    {
        $this->usuarioService = $usuarioService;
    }

    public function get()
    {
        $usuarios = $this->usuarioService->get();
        return UsuarioResource::collection($usuarios);
    }

    public function details(int $id)
    {
        try {
            $usuario = $this->usuarioService->details($id);
            return new UsuarioResource($usuario);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    }

    public function store(UsuarioStoreRequest $request)
    {
        $usuario = $this->usuarioService->store($request->validated());
        return new UsuarioResource($usuario);
    }

    public function update(int $id, UsuarioUpdateRequest $request)
    {
        try {
            $usuario = $this->usuarioService->update($id, $request->validated());
            return new UsuarioResource($usuario);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    }

    public function delete(int $id)
    {
        try {
            $usuario = $this->usuarioService->delete($id);
            return new UsuarioResource($usuario);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    }
    
    public function getReviews($id)
    {
        $usuario = \App\Models\Usuario::with('reviews')->findOrFail($id);
        return response()->json($usuario->reviews);
    }
}
