<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    //
    /**
     * Show the Home (index) page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // Search area here

        $random_books = Book::inRandomOrder()
            ->limit(6)
            ->get();

        $latest_books = Book::latest()->take(6)->get();

        $random_authors = Author::inRandomOrder()
            ->limit(6)
            ->get();

        $random_genres = Genre::inRandomOrder()
            ->take(6)
            ->get();

        return view('static.home', compact(['random_authors', 'random_books', 'latest_books', 'random_genres']));
    }
    public function about()
    {
        return view('static.about');
    }

    public function dashboard() {
        $book_count = Book::count();
        $author_count = Author::count();
        $genre_count = Genre::count();
        $publisher_count = Publisher::count();
        return view('static.dashboard', compact(
            ['book_count','author_count','genre_count','publisher_count',]
        ));
    }
}
