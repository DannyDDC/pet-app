<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalCreateRequest;
use App\Util\Helpers;
use Uuid;

class AnimalController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = Animal::orderBy('updated_at', 'desc')->paginate($request->limit);
        return $this->respondListed($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalCreateRequest $request)
    {
          $rawData = array_merge(request()->all(),['id' => Uuid::generate()->string]); 
          $newResource = Animal::create($rawData);

          $animal = Animal::findOrFail($newResource->id);
          $newValue = 'PET-NUM-'.$animal->id;
  
          $file = $request->file('petImg');
          $extension = $request->file('petImg')->extension();
          $fileName = $newValue.'.'.$extension;
          $route = $request->user_id .'/'. $fileName;
          Helpers::localStorage($route, $file);
  
          $animal->update(['ruta_imagen'=> $route]);
           
          return $this->respondCreated($animal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = Animal::findOrFail($id);            
        return $this->respondListed($resource);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
