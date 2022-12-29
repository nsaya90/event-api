<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Events::all();



        return response()->json(["events" => $events]);
    }

    public function detail($id_event)
    {


        $detail = DB::table('events')
            ->where('id', '=', $id_event)
            ->get();

        return response()->json(["events" => $detail]);
    }

    public function store(Request $request)
    {

        $request->validate(
            [

                'type' => 'required|string',
                'title' => 'required|string',
                'date' => 'required',
                'hours' => 'required|string',
                'adress' => 'required|string|min:5',
                'city' => 'required|string',
                'zip_code' => 'required|integer|min:5',
                'description' => 'required|string|max:255',
            ],
            [

                'type.required' => 'Veuillez saisir un type d\'événement valide',
                'date.required' => 'Veuillez saisir une date valide',
                'hours.required' => 'Veuillez saisir un horaire valide',
                'city.required' => 'Veuillez saisir une ville',
                'zip_code.required' => 'Veuillez saisir un code postal',
                'zip_code.min' => 'Veuillez saisir un code postal valide',
                'description.required' => 'Veuillez saisir une description',
                'title.required' => 'Veuillez saisir un titre',


            ]
        );

        $event = Events::create([
            'id_user' => $request['id_user'],
            'title' => $request['title'],
            'image' => $request['image'],
            'type' => $request['type'],
            'date' => $request['date'],
            'hours' => $request['hours'],
            'adress' => $request['adress'],
            'city' => strtolower($request['city']),
            'zip_code' => $request['zip_code'],
            'description' => $request['description'],

        ]);

        return response()->json(['event' => 'événement enregistré !', 'info-event' => $event]);
    }
    public function upload(Request $request)
    {

        // $request->image;
        // $filename = time() . '.' . $request->image->extension();
        // $request->file('image')->storeAs('images', $filename, 'public');
        $pathToFile = $request->file('image')->store('images', 'public');
        return response()->json(['message' => 'Ajout de photo réussie', 'url' => $pathToFile]);
    }
}
