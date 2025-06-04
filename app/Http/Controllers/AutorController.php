<?php

namespace App\Http\Controllers;

use App\Services\AutorService;
use App\Http\Requests\AutorStoreRequest;
use App\Http\Requests\AutorUpdateRequest;
use App\Http\Resources\AutorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AutorController extends Controller
{
    public function __construct(private AutorService $autorService)
    {

    }

    public function get()
    {
        $autores = $this->autorService->get();
        return AutorResource::collection($autores);
    }

    public function details(int $id)
    {
        try {
            $autor = $this->autorService->details($id);
            return new AutorResource($autor);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Autor não encontrado'], 404);
        }
    }

    public function store(AutorStoreRequest $request)
    {
        $validated = $request->validated();

        $autor = $this->autorService->store($validated);

        return new AutorResource($autor);
    }

    public function update(int $id, AutorUpdateRequest $request)
    {
        try {
            $autor = $this->autorService->update($id, $request->validated());
            return new AutorResource($autor);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Autor não encontrado'], 404);
        }
    }

    public function delete(int $id)
    {
        try {
            $autor = $this->autorService->delete($id);
            return new AutorResource($autor);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Autor não encontrado'], 404);
        }
    }
    public function getAutoresLivrosTitulos()
    {
        $autores = \App\Models\Autor::with(['livros:id,autor_id,titulo'])->get(['id', 'nome']);
        $resultado = $autores->map(function($autor) {
            return [
                'autor' => $autor->nome,
                'livros' => $autor->livros->map(function($livro) {
                    return $livro->titulo;
                })
            ];
        });
        return response()->json($resultado);
    }
}