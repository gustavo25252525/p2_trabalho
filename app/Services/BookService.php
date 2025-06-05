<?php

namespace App\Services;

use App\Repositories\bookRepository;
use App\Services\ReviewService;

class BookService

{
private BookRepository $bookRepository;
private ReviewService $reviewService;

public function __construct(BookRepository $bookRepository, ReviewService $reviewService){
$this->bookRepository = $bookRepository;
$this->reviewService = $reviewService;
}

public function get(){
    $books = $this->bookRepository->get();
    return $books;
}

public function details($id){
return $this->bookRepository->details($id);
}

public function store(array $data){
return $this->bookRepository->store($data);
}

public function update($id, $data){
$book = $this->bookRepository->update($id,$data);
return $book;

}

public function delete(int $id){
$book = $this->details($id);
$reviews = $book->reviews;

foreach($reviews as $review){
$this->reviewService->delete($review->id);
}
return $this->bookRepository->delete($id);
}

public function getWithReviewsAuthorAndGenres(){
return $this->bookRepository->getWithReviewsAuthorAndGenres();
}

public function findReviews(int $id){
return $this->bookRepository->findReviews($id);
}

}

