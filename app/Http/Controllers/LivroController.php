<?php

namespace App\Http\Controllers;

use App\Services\LivroService;
use App\Http\Requests\LivroStoreRequest;
use App\Http\Requests\LivroUpdateRequest;
use App\Http\Resources\LivroResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LivroController extends Controller
{
    public function __construct(private LivroService $livroService) 
    {
        $this->livroService = $livroService;
    }

    public function get()
    {
        $livros = $this->livroService->get();
        return LivroResource::collection($livros);
    }

    public function details($id)
    {
        try {
            $livro = $this->livroService->details((int)$id);
            return new LivroResource($livro);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }
    }

    public function store(LivroStoreRequest $request)
    {
        $livro = $this->livroService->store($request->validated());
        return new LivroResource($livro);
    }

    public function update($id, LivroUpdateRequest $request)
    {
        try {
            $livro = $this->livroService->update((int)$id, $request->validated());
            return new LivroResource($livro);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }
    }

    public function delete($id)
    {
        try {
            $livro = $this->livroService->delete((int)$id);
            return new LivroResource($livro);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }
    }
    public function getReviews($id)
    {
        try {
            $reviews = $this->livroService->getReviews((int)$id);
            return response()->json($reviews);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }
    }

    public function getDetalhados()
    {
        $livros = $this->livroService->getDetalhados(); 
        return LivroResource::collection($livros);
    }
}