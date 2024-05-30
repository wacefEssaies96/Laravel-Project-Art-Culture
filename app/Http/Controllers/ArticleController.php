<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Evenement;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $data['articles'] = Article::with('evenement')->get();
            return view("article.index", $data);
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
            $data['events'] = Evenement::all();
            return view("article.create", $data);
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
            //     'titre' => 'required|alpha',
            //     'contenu' => 'required',
            //     'description' => 'required'
            // ], [
            //     'title.required' => 'Title is required',
            //     'contenu.required' => 'Contenu is required',
            //     'description.required' => 'Description is required',
            // ]);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('articleImages'), $imageName);

            $article = new Article;
            $article->titre = $request->title;
            $article->image = $imageName;
            $article->description = $request->description;
            $article->contenu = $request->content;
            $article->evenement_id = $request->event_id;
            $article->save();

            return redirect()->route('articles.index')
                ->with('success', 'Article has been created successfully.');
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
            $article = Article::find($id);
            return view('article.show', compact('article'));
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
            $events = Evenement::all();
            $article = Article::find($id);
            return view('article.edit', compact('article', 'events'));
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
            $article = Article::find($id);
            if (!is_string($request->image)) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('articleImages'), $imageName);
                $article->image = $imageName;
            }
            $article->titre = $request->title;
            $article->description = $request->description;
            $article->contenu = $request->content;
            $article->evenement_id = $request->event_id;
            $article->save();

            return redirect()->route('articles.index')
                ->with('success', 'Article Has Been updated successfully');
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
            $article = Article::where('id', $id)->firstOrFail();
            $article->delete();
            return redirect()->route('articles.index')
                ->with('success', 'Article has been deleted successfully');
        } else {
            return redirect()->back();
        }
    }
}
