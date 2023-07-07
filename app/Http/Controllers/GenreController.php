<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Add the permissions during object instantiation.
     *
     */
    function __construct()
    {
        // TODO: Need to create a suitable "not authorised" JSON response.
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $genres = Genre::paginate(20);
        return view('genres.index', compact(['genres',]));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('genres.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGenreRequest  $request
     */
    public function store(StoreGenreRequest $request)
    {
        $genre = Genre::create($request->validated());

        return redirect()->route('genres.index')
            ->with('success', "Genre {$genre->name} created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre*
     */
    public function show(Genre $genre)
    {
        //
        return view('genres.show', compact(['genre',]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre $genre
     */
    public function edit(Genre $genre)
    {
        //
        return view('genres.edit', compact(['genre'],));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGenreRequest  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        foreach ($request->validated() as $validKey => $validValue) {
            $genre[$validKey] = $validValue;
        }

        $genre->save();

        return redirect()->route('genres.index')
            ->with('success', 'Genre updated successfully.');
    }

    /**
     * Verify the removal from storage.
     *
     * @param  \App\Models\Genre $genre
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function delete(Genre $genre)
    {
        return view('genres.delete', compact(['genre',]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')
            ->with('success', 'Genre deleted successfully.');
    }
}
