<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateAPIRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseField;

class BookAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint("api/book","200 - Return the books that are available")]
    #[Attributes\UrlParam("id", "int", "The book's ID.", required: true, example: 1)]
    #[Response(["success"=>"true", "message"=>"Retrieved successfully","data"=>"books"], status:200)]
    #[ResponseField("id","Book ID")]
    #[ResponseField("title","Book title")]
    #[ResponseField("subtitle","Book subtitle")]
    #[ResponseField("year_published","Book year_published")]
    #[ResponseField("edition","Book edition")]
    #[ResponseField("isbn_10","Book isbn_10")]
    #[ResponseField("isbn_13","Book isbn_13")]
    #[ResponseField("height","Book height")]
    #[ResponseField("genre","Book genre")]
    #[ResponseField("sub_genre","Book sub_genre")]

    public function index(PaginateAPIRequest $request) : JsonResponse
    {

        $books = Book::simplePaginate($request["per_page"]);
        //$books = Book::all();
        if (!is_null($books) && $books->count() > 0) {
            return $this->sendResponse(
                $books,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No Books Found");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
