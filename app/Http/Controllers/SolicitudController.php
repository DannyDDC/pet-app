<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Animal;
use App\Models\User;
use App\Util\Helpers;
use Illuminate\Http\Request;

class SolicitudController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rawData = request()->all(); 
        $newResource = Solicitud::create($rawData);
        $animal = Animal::findOrFail($newResource->animal_id);
        $owner = User::findOrFail($animal->user_id);
        
        $emailData = Solicitud::findOrFail($newResource->id);
        $emailData->recipients = $owner->email;
        $emailData->name = $owner->name;
        $emailData->pet_name = $animal->nombre;
        Helpers::sendEmail($emailData, 'request_create');
         
        return $this->respondCreated($newResource);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
