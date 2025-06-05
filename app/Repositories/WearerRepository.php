<?php

namespace App\Repositories;

use App\Models\Wearer;

class WearerRepository
{
public function get(){
    return Wearer::all();
}

public function details(int $id){
    return Wearer::findOrFail($id);
}

public function store(array $data){
    return Wearer::create($data);
}

public function update(int $id, array $data){
    $wearer = $this->details($id);
    $wearer->update($data);
    return $wearer;
}

public function delete(int $id){
    $wearer = $this->details($id);
    $wearer->delete();
    return $wearer;
}



public function findReviews(int $id){
    $wearer = $this->details($id);
    return $wearer->reviews;
}
}