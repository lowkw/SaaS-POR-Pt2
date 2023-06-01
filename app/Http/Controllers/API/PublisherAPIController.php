<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ApiBaseController;
use App\Http\Requests\PaginateAPIRequest;
use App\Http\Requests\StorePublisherAPIRequest;
use App\Http\Requests\UpdatePublisherAPIRequest;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Knuckles\Scribe\Attributes;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseField;

class PublisherAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint("api/publisher","200 - Return the publishers that are available")]
    #[Attributes\UrlParam("id", "int", "The publisher's ID.", required: true, example: 1)]
    #[Response(["success"=>"true", "message"=>"Retrieved successfully","data"=>"publishers"], status:200)]
    #[ResponseField("id","Publisher ID")]
    #[ResponseField("name","Publisher name")]
    #[ResponseField("city","Publisher city")]
    #[ResponseField("country code","Publisher country code")]
    public function index(PaginateAPIRequest $request) : JsonResponse
    {

        $publishers = Publisher::simplePaginate($request["per_page"]);
        //$publishers = Publisher::all();
        if (!is_null($publishers) && $publishers->count() > 0) {
            return $this->sendResponse(
                $publishers,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No Publishers Found");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePublisherAPIRequest $request
     * @return JsonResponse
     */
    public function store(StorePublisherAPIRequest $request)
    {
        $validated = $request->validated();
        $publisher = Publisher::create($validated);
        return $this->sendResponse(
            $publisher,
            "Created successfully."
        );
    }

    /**
     * Retrieve a publisher
     *
     * Given a URL parameter of the ID of a Publisher, the publisher's details are returned with status 200
     *
     * If the Publisher ID is invalid then a status code of 404 is returned.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $publishers = Publisher::query()->where('id',$id)->first();
        if (!is_null($publishers) && $publishers->count() > 0) {
            return $this -> sendResponse(
                $publishers,
                "Retrieved successfully.",
            );
        }
        return $this->sendError("Publisher Not Found");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePublisherAPIRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdatePublisherAPIRequest $request, int $id)
    {
        $validated = $request->validated();
        $publishers = Publisher::query()->where('id',$id)->first();
        if (!is_null($publishers) && $publishers->count()>0){
            $publishers['name']=$validated['name'];
            $publishers['city']=$validated['city'];
            $publishers['country_code']=$validated['country_code'];
            $publishers['updated_at']=Carbon::now();
            $publishers->save();

            return $this -> sendResponse(
                $publishers,
                "Updated successfully.",
            );
        }
        return $this->sendError("Publisher Not Found and Not Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $destroyedPublisher = $publisher = Publisher::query()->where('id',$id)->first();


        if (!is_null($publisher) && $publisher->count()>0){
            $publisher->delete();

            return $this -> sendResponse(
                $destroyedPublisher,
                "Deleted successfully.",
            );
        }
        return $this->sendError("Publisher Not Found and Not Deleted.");
    }
}
