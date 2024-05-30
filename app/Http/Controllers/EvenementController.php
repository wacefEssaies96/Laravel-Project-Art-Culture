<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Commentaire;
use App\Models\Emoji;
use App\Models\Evenement;
use App\Models\Place;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $data['evenements'] = Evenement::paginate(5);
            return view('evenements.index', $data);
        } else {
            return redirect()->back();
        }
    }

    public function indexFront()
    {
        $data['evenements'] = Evenement::with('place')->get();
        return view('evenements.front-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role === 'admin') {

            $data['actors'] = Actor::all();
            $data['places'] = Place::all();
            return view('evenements.create', $data);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role === 'admin') {

            // $request->validate([
            //     'nom' => 'required|alpha',
            //     'email' => 'required|email',
            //     'address' => 'required'
            // ]);
            // dd($request->image);

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('eventImages'), $imageName);

            $evenement = new Evenement;

            $evenement->nom = $request->nom;
            $evenement->image = $imageName;
            $evenement->date_debut = $request->dateDebut;
            $evenement->date_fin = $request->dateFin;
            $evenement->description = $request->description;
            $evenement->places_id = $request->place_id;
            $evenement->save();

            $evenement->actors()->attach($request->input('actors'));

            return redirect()->route('events.index')
                ->with('success', 'Event has been created successfully.');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evenement = Evenement::with('articles')->find($id);
        $commentaires = Commentaire::orderBy('updated_at', 'desc')->get();
        $emojis = Emoji::all();
        return view('evenements.show',compact('evenement','commentaires','emojis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role === 'admin') {
            $evenement = Evenement::find($id);
            return view('evenements.edit', compact('evenement'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role === 'admin') {
            $evenement = Evenement::find($id);
            if (!is_string($request->image)) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('eventImages'), $imageName);
                $evenement->image = $imageName;
            }
            $evenement->nom = $request->nom;
            $evenement->date_debut = $request->dateDebut;
            $evenement->date_fin = $request->dateFin;
            $evenement->description = $request->description;

            $evenement->save();

            return redirect()->route('events.index')
                ->with('success', 'Event Has Been updated successfully');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role === 'admin') {
            $evenement = Evenement::where('id', $id)->firstOrFail();
            $evenement->delete();
            return redirect()->route('events.index')
                ->with('success', 'Event has been deleted successfully');
        } else {
            return redirect()->back();
        }
    }
}
