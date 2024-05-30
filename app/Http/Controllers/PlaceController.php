<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\PlaceRequest;

class PlaceController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $places = Place::all();
            return view('pages.place-management', compact('places'));
        } else {
            return redirect()->back();
        }
    }


    public function create()
    {
        if (auth()->user()->role === 'admin') {
            return view('pages.place.create');
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'capacity' => 'nullable|integer',
                'description' => 'nullable|string',
                'category' => 'nullable|string',
                'facilities' => 'nullable|string',
                'accessibility' => 'nullable|string',
                'internal_rules' => 'nullable|string',
                'photos' => 'nullable|array',
                'website' => 'nullable|url',
                'phone_number' => 'nullable|regex:/^[0-9]{8}$/|numeric',
                // 10 chiffres
                'email' => 'nullable|email',
                'social_media_links' => 'nullable|array',
            ]);
            $data = $request->all();
            $place = Place::create($data);
            return redirect()->route('places.index');
        } else {
            return redirect()->back();
        }
    }

    public function show(Place $place)
    {
        if (auth()->user()->role === 'admin') {
            return view('pages.place.show', compact('place'));
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (auth()->user()->role === 'admin') {
            $place = Place::findOrFail($id);
            return view('pages.place.edit', compact('place'));
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'capacity' => 'nullable|integer',
                'description' => 'nullable|string',
                'category' => 'nullable|string',
                'facilities' => 'nullable|array',
                'accessibility' => 'nullable|string',
                'internal_rules' => 'nullable|string',
                'photos' => 'nullable|array',
                'website' => 'nullable|url',
                'phone_number' => 'nullable|regex:/^[0-9]{8}$/|numeric',
                // 10 chiffres
                'email' => 'nullable|email',
                'social_media_links' => 'nullable|array',
                'rental_cost' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                // Nombre avec 2 décimales au maximum
            ]);
            $data = $request->all();

            $place = Place::find($id);

            if (!$place) {
                return redirect()->route('places.index')->with('error', 'Lieu non trouvé.');
            }

            $place->update($data);

            return redirect()->route('places.index')->with('success', 'Lieu mis à jour avec succès.');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->role === 'admin') {
            $place = Place::find($id);
            $place->delete();
            return redirect()->route('places.index')->with('success', 'Lieu supprimé avec succès.');
        } else {
            return redirect()->back();
        }
    }
}

