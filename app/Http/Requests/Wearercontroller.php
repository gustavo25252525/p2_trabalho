<?php

namespace App\Http\Controllers;
use App\Http\Requests\WearerUpdateRequest;
use App\Http\Resources\WearerResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\WearerService;
use App\Http\Requests\WearerStoreRequest;

class Wearercontroller extends Controller
{
   
private wearerService $wearerService;
public function __construct(wearerService $wearerService)
{
$this->wearerService = $wearerService;
}

public function get()
{
$wearers = $this->wearerService->get();
return WearerResource::collection($wearers);
}

public function details($id){
try{
$wearer = $this->wearerService->details($id);

}
catch(ModelNotFoundException $e){
return response()->json(['error'=>'wearer not found', 404]);
}
return new WearerResource($wearer);
}

public function store(WearerStoreRequest $request){
$data = $request->validated();
$wearer = $this->wearerService->store($data);
return new WearerResource($wearer);
}

public function update(int $id, WearerUpdateRequest $request){
$data = $request->validated();
try{
$wearer = $this->wearerService->update($id, $data);
}
catch(ModelNotFoundException $e){
return response()->json(['error'=>'wearer not found', 404]);
}
return new WearerResource($wearer);
}

public function delete(int $id){
try{
$wearer = $this->wearerService->delete($id);
}catch(ModelNotFoundException $e){
return response()->json(['error'=>'wearer not found', 404]);
}
return new WearerResource($wearer);
}


public function findReviews(int $id){
try{
$reviews = $this->wearerService->findReviews($id);
}
catch(ModelNotFoundException $e){
return response()->json(['error'=>'wearer not found', 404]);
}
return ReviewResource::collection($reviews);
}
}


