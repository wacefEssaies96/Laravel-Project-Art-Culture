<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Evenement;
use App\Models\Area;
class UserPlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();

        return view('account-pages.places', compact('places'));
    }



    public function showPlaceAreas($placeId)
{
    // Récupérer le lieu en fonction de son ID
    $event = Evenement::find($placeId);

    // Vérifier si le lieu existe
    if (!$event) {
        // Gérer le cas où le lieu n'existe pas, par exemple, rediriger ou afficher un message d'erreur.
        return redirect()->route('errorplace')->with('error', 'L evenement n\'existe pas.');
        // Vous devez définir une route avec un nom approprié pour gérer les erreurs.
    }
$place=Place::find($event->places_id);
if (!$event) {
    // Gérer le cas où le lieu n'existe pas, par exemple, rediriger ou afficher un message d'erreur.
    return redirect()->route('errorplace')->with('error', 'le lieu n\'existe pas.');
    // Vous devez définir une route avec un nom approprié pour gérer les erreurs.
}
    // Récupérer toutes les zones associées à ce lieu
    $areas = Area::where('places_id', $place->id)->get();

    return view('account-pages.event-places', compact('areas', 'place'));
}




}
