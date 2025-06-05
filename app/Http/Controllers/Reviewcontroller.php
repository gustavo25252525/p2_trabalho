<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\WearerResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\ReviewService;

class Reviewcontroller extends Controller


{
    private ReviewService $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function get()
    {
        $reviews = $this->reviewService->get();
        return ReviewResource::collection($reviews);
    }

    public function details($id)
    {
        try {
            $review = $this->reviewService->details($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Review not found', 404]);
        }
        return new ReviewResource($review);
    }

    public function store(ReviewStoreRequest $request)
    {
        $data = $request->validated();
        $review = $this->reviewService->store($data);
        return new ReviewResource($review);
    }

    public function update(int $id, ReviewUpdateRequest $request)
    {
        $data = $request->validated();
        try {
            $review = $this->reviewService->update($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Review not found', 404]);
        }
        return new ReviewResource($review);
    }

    public function delete(int $id)
    {
        try {
            $review = $this->reviewService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Review not found', 404]);
        }
        return new ReviewResource($review);
    }

    public function findBooks(int $id){
     try{
        $books = $this->reviewService->findBooks($id);
    }
    catch(ModelNotFoundException $e){
    return response()->json(['error'=>'Review not found', 404]);
    }
    return BookResource::collection($books);
    }
    public function findWearer(int $id){
        try{
         $wearers = $this->reviewService->findWearers($id);
    }
    catch(ModelNotFoundException $e){
    return response()->json(['error'=>'Review not found', 404]);
    }
    return WearerResource::collection($wearers);
    }
    }





