<?php

namespace App\Http\Controllers;

use App\Services\GeneroService;
use App\Http\Requests\GeneroStoreRequest;
use App\Http\Requests\GeneroUpdateRequest;
use App\Http\Resources\GeneroResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GeneroController extends Controller
{
    public function __construct(private GeneroService $generoService) 
    {
        $this->generoService = $generoService;
    }

    public function get()
    {
        $generos = $this->generoService->get();
        return GeneroResource::collection($generos);
    }

    public function details(int $id)
    {
        try {
            $genero = $this->generoService->details($id);
            return new GeneroResource($genero);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Gênero não encontrado'], 404);
        }
    }

    public function store(GeneroStoreRequest $request)
    {
        $genero = $this->generoService->store($request->validated());
        return new GeneroResource($genero);
    }

    public function update(int $id, GeneroUpdateRequest $request)
    {
        try {
            $genero = $this->generoService->update($id, $request->validated());
            return new GeneroResource($genero);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Gênero não encontrado'], 404);
        }
    }

    public function delete(int $id)
    {
        try {
            $genero = $this->generoService->delete($id);
            return new GeneroResource($genero);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Gênero não encontrado'], 404);
        }
    }
    public function getLivros($id)
    {
        $genero = \App\Models\Genero::with('livros')->findOrFail($id);
        return response()->json($genero->livros);
    }
}