<?php

namespace App\Services;

use App\Repositories\GenreRepository;


class GenreService

{
private GenreRepository $genreRepository;


public function __construct(GenreRepository $genreRepository){
$this->genreRepository = $genreRepository;

}

public function get(){
$categories = $this->genreRepository->get();
return $categories;
}

public function details($id){
return $this->genreRepository->details($id);
}

public function store(array $data){
return $this->genreRepository->store($data);
}

public function update($id, $data){
$genre = $this->genreRepository->update($id,$data);
return $genre;

}

public function delete(int $id){
$genre = $this->details($id);
$books = $genre->books;


foreach($books as $book){
$book->update(['genre_id' => null]);
}
return $this->genreRepository->delete($id);
}

public function getWithBooks(){
return $this->genreRepository->getWithBooks();
}

public function findBooks(int $id){
return $this->genreRepository->findBooks($id);
}

}

