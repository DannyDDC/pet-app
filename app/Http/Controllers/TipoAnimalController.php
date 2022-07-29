<?php

namespace App\Http\Controllers;

use App\Models\TipoAnimal;
use Illuminate\Http\Request;

class TipoAnimalController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = TipoAnimal::orderBy('updated_at', 'desc')->get();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoAnimal  $tipoAnimal
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAnimal $tipoAnimal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoAnimal  $tipoAnimal
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoAnimal $tipoAnimal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoAnimal  $tipoAnimal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoAnimal $tipoAnimal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoAnimal  $tipoAnimal
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoAnimal $tipoAnimal)
    {
        //
    }
}
