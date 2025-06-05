<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\BookService;


class Bookcontroller extends Controller
{
    private BookService $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function get()
    {
        $books = $this->bookService->get();
        
        return BookResource::collection($books);
    }

    public function details($id)
    {
        try {
            $book = $this->bookService->details();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found', 404]);
        }
        return new BookResource($book);
    }

    public function store(BookStoreRequest $request)
    {
        $data = $request->validated();
        $book = $this->bookService->store($data);
        return new BookResource($book);
    }

    public function update(int $id, BookUpdateRequest $request)
    {
        $data = $request->validated();
        try {
            $book = $this->bookService->update($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found', 404]);
        }
        return new BookResource($book);
    }

    public function delete(int $id)
    {
        try {
            $book = $this->bookService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found', 404]);
        }
        return new BookResource($book);
    }

    public function getWithReviewsAuthorAndGenres()
    {
        $books = $this->bookService->getWithReviewsAuthorAndGenres();
        return BookResource::collection($books);
    }

    public function findReviews(int $id)
    {
        try {
            $reviews = $this->bookService->findReviews($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'book not found', 404]);
        }
        return BookResource::collection($reviews);
    }
}
