<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewController extends Controller
{
    public function __construct(private ReviewService $reviewService) 
    {
        $this->reviewService = $reviewService;
    }

    public function get()
    {
        $reviews = $this->reviewService->get();
        return ReviewResource::collection($reviews);
    }

    public function details(int $id)
    {
        try {
            $review = $this->reviewService->details($id);
            return new ReviewResource($review);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Review não encontrado'], 404);
        }
    }

    public function store(ReviewStoreRequest $request)
    {
        $review = $this->reviewService->store($request->validated());
        return new ReviewResource($review);
    }

    public function update(int $id, ReviewUpdateRequest $request)
    {
        try {
            $review = $this->reviewService->update($id, $request->validated());
            return new ReviewResource($review);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Review não encontrado'], 404);
        }
    }

    public function delete(int $id)
    {
        try {
            $review = $this->reviewService->delete($id);
            return new ReviewResource($review);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Review não encontrado'], 404);
        }
    }
}
