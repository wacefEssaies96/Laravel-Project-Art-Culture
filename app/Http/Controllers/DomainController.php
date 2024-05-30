<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Domain;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $domains = Domain::all();
            $actorsByDomain = Domain::with('actors')->orderBy('name')->get();

            return view('pages.DomainManagement.index', compact('domains'), compact('actorsByDomain'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role === 'admin') {
            return view('pages.DomainManagement.create');
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
            $domain = new Domain([
                "name" => $request->get('name'),
                "description" => $request->get('description')
            ]);

            $request->validate([
                'name' => 'required|max:20',
                'description' => 'required'
            ]);

            $domain->save();

            return redirect()->route('domain-management.index')->with('success', 'Domain is added successfully !');
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
        if (auth()->user()->role === 'admin') {
            $domain = Domain::find($id);

            if (!$domain) {
                return redirect()->route('domain-management.index')->with('error', 'Domain not found !');
            }
            return view('pages.DomainManagement.domain', compact('domain'));
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
    public function edit($id)
    {
        if (auth()->user()->role === 'admin') {
            $domain = Domain::find($id);

            if (!$domain) {
                return redirect()->route('domain-management.index')->with('error', 'Domain not found !');
            }

            return view('pages.DomainManagement.edit', compact('domain'), compact('domain'));
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
            if ($id) {
                $domain = Domain::find($id);

                $request->validate([
                    'name' => 'required|max:20',
                    'description' => 'required'
                ]);

                $domain->name = $request->name;
                $domain->description = $request->description;
                $domain->save();

                return redirect()->route('domain-management.index')->with('success', 'Domain is updated successfully !');

            } else {
                return redirect()->route('domain-management.index')->with('error', 'Domain not found !');
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
            $domain = Domain::find($id);
            if (!$domain) {
                return redirect()->route('domain-management.index')->with('error', 'Domain not found !');
            }
            $domain->delete();
            return redirect()->route('domain-management.index')->with('success', 'Domain is deleted with success !');
        } else {
            return redirect()->back();
        }
    }
}
