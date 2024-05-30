<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Actor;
use \App\Models\Domain;
use App\Http\Requests\ActorRequest;
use Goutte\Client;

class ActorManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $actors = Actor::with('domains')->get();
            return view('pages.ActorManagement.index', compact('actors'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (auth()->user()->role === 'admin') {

            $domains = Domain::all();
            $imageElement = null;

            if ($request->fullName) {
                $fullName = $request->fullName;

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

                return view('pages.ActorManagement.create', compact('domains', 'fullName', 'imageElement', 'data'));
            }
            return view('pages.ActorManagement.create', compact('domains', 'imageElement'));
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
    public function store(ActorRequest $request)
    {
        if (auth()->user()->role === 'admin') {

            $imageName = time() . '.' . $request->profilePicture->extension();

            $request->profilePicture->move(public_path('actorPictures'), $imageName);

            $actor = new Actor([
                "fullName" => $request->get('fullName'),
                "birthDate" => $request->get('birthDate'),
                "birthPlace" => $request->get('birthPlace'),
                "biography" => $request->get('biography'),
                "nationality" => $request->get('nationality'),
                "specialties" => $request->get('specialties'),
                "profilePicture" => $imageName,
                "email" => $request->get('email'),
                "phoneNumber" => $request->get('phoneNumber'),
                "socialConnections" => $request->get('socialConnections'),
                "discography" => $request->get('discography'),
                "availability" => $request->get('availability'),
            ]);

            $actor->save();

            $actor->domains()->attach($request->input('domains'));

            return redirect()->route('actor-management.index')->with('success', 'Actor is added successfully !');
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
    public function show(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $id = $request->query('id');
            $actor = Actor::with('domains')->find($id);

            if (!$actor) {
                return redirect()->route('actor-management.index')->with('error', 'Actor not found !');
            }
            return view('pages.ActorManagement.actor', compact('actor'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $id = $request->query('id');
            $actor = Actor::with('domains')->find($id);
            $domains = Domain::all();

            return view('pages.ActorManagement.edit', compact('actor'), compact('domains'));
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
    public function update(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $id = $request->query('id');
            if ($id) {
                $actor = Actor::find($id);

                $request->validate([
                    'fullName' => 'required|max:30',
                    'email' => 'required',
                    'phoneNumber' => 'required|numeric',
                    'profilePicture' => 'required',
                    'birthDate' => 'required|date|before:today',
                ], [
                    'birthDate.required' => "BirthDate is required !"
                ]);

                if (!is_string($request->profilePicture)) {
                    $imageName = time() . '.' . $request->profilePicture->extension();
                    $request->profilePicture->move(public_path('actorPictures'), $imageName);
                    $actor->profilePicture = $imageName;
                }

                $actor->fullName = $request->fullName;
                $actor->birthDate = $request->birthDate;
                $actor->birthPlace = $request->birthPlace;
                $actor->biography = $request->biography;
                $actor->nationality = $request->nationality;
                $actor->email = $request->email;
                $actor->phoneNumber = $request->phoneNumber;
                $actor->socialConnections = $request->socialConnections;
                $actor->discography = $request->discography;
                $actor->availability = $request->availability;
                $actor->save();

                $actor->domains()->sync($request->input('domains'));

                return redirect()->route('actor-management.index')->with('success', 'Actor is updated successfully !');

            } else {
                return redirect()->route('actor-management.index')->with('error', 'Actor not found !');
            }
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
            $actor = Actor::find($id);
            if (!$actor) {
                return redirect()->route('actor-management.index')->with('error', 'Actor not found !');
            }
            $actor->delete();
            return redirect()->route('actor-management.index')->with('success', 'Actor is deleted with success !');
        } else {
            return redirect()->back();
        }
    }

    public function scrape(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            // $users = User::where('name', 'like', '%' . $keyword . '%')->get();

            $fullName = $request->fullName;

            $client = new Client();

            $url = 'https://fr.wikipedia.org/wiki/' . $fullName;
            $crawler = $client->request('GET', $url);

            // $title = $crawler->filter('.infobox_v3 > .entete > div')->text();

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
            return view('pages.actor-management.create', compact('fullName', 'imageElement', 'data'));
        } else {
            return redirect()->back();
        }
    }

}
