<?php
namespace App\Services;
use App\Repositories\AutorRepository;

class AutorService
{
    protected AutorRepository $autorRepository;

    public function __construct(AutorRepository $autorRepository)
    {
        $this->autorRepository = $autorRepository;
    }

    public function get()
    {
        $autor = $this->autorRepository->get();
        return $autor;
    }

    public function details(int $id)
    {
        $autor = $this->autorRepository->details($id);
        return $autor;
    }

    public function store(array $data)
    {
        $autor = $this->autorRepository->store($data);
        return $autor;
    }

    public function update(int $id, array $data)
    {
        $autor = $this->autorRepository->update($id, $data);
        return $autor;
    }

    public function delete(int $id)
    {
        $autor = $this->autorRepository->delete($id);
        return $autor;
    }
    
} 