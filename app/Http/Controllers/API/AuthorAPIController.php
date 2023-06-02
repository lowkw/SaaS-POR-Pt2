<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateAPIRequest;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseField;

class AuthorAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint("api/author","200 - Return the authors that are available")]
    #[Attributes\UrlParam("id", "int", "The author's ID.", required: true, example: 1)]
    #[Response(["success"=>"true", "message"=>"Retrieved successfully","data"=>"authors"], status:200)]
    #[ResponseField("id","Author ID")]
    #[ResponseField("given_name","Given name")]
    #[ResponseField("family_name","Family name")]
    #[ResponseField("is_company","True or false")]
    public function index(PaginateAPIRequest $request) : JsonResponse
    {

        $authors = Author::simplePaginate($request["per_page"]);
        //$authors = Author::all();
        if (!is_null($authors) && $authors->count() > 0) {
            return $this->sendResponse(
                $authors,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No Authors Found");
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
