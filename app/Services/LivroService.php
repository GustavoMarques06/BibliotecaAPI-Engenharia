<?php
namespace App\Services;
use App\Repositories\LivroRepository;

class LivroService
{
    public LivroRepository $livroRepository;

    public function __construct(LivroRepository $livroRepository)
    {
        $this->livroRepository = $livroRepository;
    }

    public function get()
    {
        $livro = $this->livroRepository->get();
        return $livro;
    }

    public function details(int $id)
    {
        $livro = $this->livroRepository->details($id);
        return $livro;
    }

    public function store(array $data)
    {
        $livro = $this->livroRepository->store($data); 
        return $livro;
    }

    public function update(int $id, array $data)
    {
        $livro = $this->livroRepository->update($id, $data);
        return $livro;
    }

    public function delete(int $id)
    {
        $livro = $this->livroRepository->delete($id); 
        return $livro;
    }  
    public function getReviews(int $livroId)
    {
        $livro = $this->livroRepository->details($livroId);
        return $livro->reviews; 
    }

    public function getDetalhados()
    {
        $livros = $this->livroService->getDetalhados(); 
        return LivroResource::collection($livros);
    }
}