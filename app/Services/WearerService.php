<?php

namespace App\Services;

use App\Repositories\WearerRepository;
use App\Services\ReviewService;

class WearerService

{
private WearerRepository $wearerRepository;
private ReviewService $reviewService;

public function __construct(WearerRepository $wearerRepository, ReviewService $reviewService){
$this->wearerRepository = $wearerRepository;
$this->reviewService = $reviewService;
}

public function get(){
$categories = $this->wearerRepository->get();
return $categories;
}

public function details($id){
return $this->wearerRepository->details($id);
}

public function store(array $data){
return $this->wearerRepository->store($data);
}

public function update($id, $data){
$wearer = $this->wearerRepository->update($id,$data);
return $wearer;

}

public function delete(int $id){
$wearer = $this->details($id);
$reviews = $wearer->reviews;

foreach($reviews as $review){
$this->reviewService->delete($review->id);
}
return $this->wearerRepository->delete($id);
}

public function findReviews(int $id){
return $this->wearerRepository->findReviews($id);
}

}

