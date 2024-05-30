<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Actor;
use \App\Models\Domain;
use Goutte\Client;

class ArtistInformation extends Controller
{
    public function index()
    {
        $actors = Actor::with('domains')->get();
        return view ('pages.FrontOffice.artistsInfo', compact('actors')) ;
    }

    public function searchByName(Request $request)
    {
        $fullName = $request->fullName;
        $results = Actor::where('fullName', 'like', "%$fullName%")->get();
        if (!$results) {
            return redirect()->route('pages.FrontOffice.artistsInfo')->with('error', 'Artist with this name is not found !');
        }
        return view('pages.FrontOffice.artistByName', compact('results', 'fullName'));
    }

    public function scrape(Request $request)
    {
        $fullName = $request->fullName;

        $results = Actor::where('fullName', 'like', "%$fullName%")->get();
        if (count($results) > 0) {
            return view('pages.FrontOffice.artistByName', compact('results', 'fullName'));
        } else {
            $client = new Client();

            $url = 'https://fr.wikipedia.org/wiki/' . $fullName;
            $crawler = $client->request('GET', $url);

            $imageElement = $crawler->filter('.infobox_v3 .images .mw-default-size .mw-file-description img')->first()->attr('src');

            $tableTH = $crawler->filter('.infobox_v3 table')->filter('tbody tr')->each(function ($row) {
                return $row->filter('th')->each(function ($cell) {
                    return $cell->text();
                });
            });

            $tableTD = $crawler->filter('.infobox_v3 table')->filter('tbody tr')->each(function ($row) {
                return $row->filter('td')->each(function ($cell) {
                    return $cell->text();
                });
            });

            $data = new \stdClass();

            foreach ($tableTH as $index => $key) {
                $k = $key[0];
                $data->$k = $tableTD[$index];
            }
            return view('pages.FrontOffice.artistByName', compact('results', 'fullName', 'imageElement', 'tableTH', 'tableTD', 'data'));
        }
    }
}
