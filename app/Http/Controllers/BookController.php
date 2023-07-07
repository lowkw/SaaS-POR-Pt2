<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
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
        $books = Book::paginate(20);
        return view('books.index', compact(['books',]));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $genres = Genre::all();
        return view('books.create',compact(['genres',]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        $genres=[Genre::where('name',$book['genre'])->value('id'),Genre::where('name',$book['sub_genre'])->value('id'),];
        $book->genres()->attach($genres);

        return redirect()->route('books.index')
            ->with('success', "Book {$book->title} created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book*
     */
    public function show(Book $book)
    {
        //
        return view('books.show', compact(['book',]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book $book
     */
    public function edit(Book $book)
    {
        //
        $genres = Genre::all();
        return view('books.edit', compact(['book','genres']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        foreach ($request->validated() as $validKey => $validValue) {
            $book[$validKey] = $validValue;
        }

        $book->save();

        $genres=[Genre::where('name',$book['genre'])->value('id'),Genre::where('name',$book['sub_genre'])->value('id'),];
        $book->genres()->sync($genres);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Verify the removal from storage.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function delete(Book $book)
    {
        return view('books.delete', compact(['book',]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->genres()->detach();
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
