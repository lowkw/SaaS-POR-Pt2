<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateAPIRequest;
use App\Http\Requests\StoreGenreAPIRequest;
use App\Http\Requests\UpdateGenreAPIRequest;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Knuckles\Scribe\Attributes;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseField;

class GenreAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint("api/genre","200 - Return the genre that are available")]
    #[Attributes\UrlParam("id", "int", "The genre's ID.", required: true, example: 1)]
    #[Response(["success"=>"true", "message"=>"Retrieved successfully","data"=>"genres"], status:200)]
    #[ResponseField("id","Genre ID")]
    #[ResponseField("name","Genre name")]
    #[ResponseField("description","Genre description")]
    public function index(PaginateAPIRequest $request) : JsonResponse
    {

        $genres = Genre::simplePaginate($request["per_page"]);
        //$genres = Genre::all();
        if (!is_null($genres) && $genres->count() > 0) {
            return $this->sendResponse(
                $genres,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No Genres Found");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGenreAPIRequest $request
     * @return JsonResponse
     */
    public function store(StoreGenreAPIRequest $request)
    {
        $validated = $request->validated();
        $genre = Genre::create($validated);
        return $this->sendResponse(
            $genre,
            "Created successfully."
        );
    }

    /**
     * Retrieve a genre
     *
     * Given a URL parameter of the ID of a Genre, the genre's details are returned with status 200
     *
     * If the Genre ID is invalid then a status code of 404 is returned.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $genres = Genre::query()->where('id',$id)->first();
        if (!is_null($genres) && $genres->count() > 0) {
            return $this -> sendResponse(
                $genres,
                "Retrieved successfully.",
            );
        }
        return $this->sendError("Genre Not Found");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGenreAPIRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateGenreAPIRequest $request, int $id)
    {
        $validated = $request->validated();
        $genres = Genre::query()->where('id',$id)->first();
        if (!is_null($genres) && $genres->count()>0){
            $genres['name']=$validated['name'];
            $genres['description']=$validated['description'];
            $genres['updated_at']=Carbon::now();
            $genres->save();

            return $this -> sendResponse(
                $genres,
                "Updated successfully.",
            );
        }
        return $this->sendError("Genre Not Found and Not Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $destroyedGenre = $genre = Genre::query()->where('id',$id)->first();


        if (!is_null($genre) && $genre->count()>0){
            $genre->delete();

            return $this -> sendResponse(
                $destroyedGenre,
                "Deleted successfully.",
            );
        }
        return $this->sendError("Genre Not Found and Not Deleted.");
    }
}
