<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {

        $request->validate(
            [
                'nickname' => 'required|string',
                'type' => 'required|string',
                'date' => 'required|string',
                'hours' => 'required|string',
                'adress' => 'required|string|min:5',
                'city' => 'required|string',
                'zip-code' => 'required|numeric|min:5',
                'description' => 'required|string|max:255',
            ],
            [
                'nickname.required' => 'Veuillez saisir un Nom d\'artiste valide',
                'type.required' => 'Veuillez saisir un type d\'événement valide',
                'date.required' => 'Veuillez saisir une date valide',
                'hours.required' => 'Veuillez saisir un horaire valide',
                'city.required' => 'Veuillez saisir une ville',
                'zip-code.required' => 'Veuillez saisir une ville',
                'zip-code.min' => 'Veuillez saisir un code postal valide',
                'description.required' => 'Description trop longue',

            ]
        );

        $event = Events::create([
            'id_user' => $request['id_user'],
            'nickname' => $request['nickname'],
            'type' => $request['type'],
            'date' => $request['date'],
            'hours' => $request['hours'],
            'adress' => $request['adress'],
            'city' => $request['city'],
            'zip-code' => $request['zip-code'],
            'description' => $request['description'],

        ]);

        return response()->json(['event' => 'événement enregistré !', 'info-event' => $event]);
    }
}
