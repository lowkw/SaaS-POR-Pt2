<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateAPIRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseField;

class UserAPIController extends Controller
{
    /**
     * Display a listing of the resource.*
     */
    #[Endpoint("api/user","200 - Return the users that are available")]
    #[Attributes\UrlParam("id", "int", "The user's ID.", required: true, example: 1)]
    #[Response(["success"=>"true", "message"=>"Retrieved successfully","data"=>"users"], status:200)]
    #[ResponseField("id","User ID")]
    #[ResponseField("name","User name")]
    #[ResponseField("email","eMail address")]
    public function index(PaginateAPIRequest $request) : JsonResponse
    {
        //$users = User::all();
        $users = User::simplePaginate($request["per_page"]);
        return response()->json(
            [
                'status' => true,
                'message'=> "Retrieved successfully.",
                'data'=> [
                    'users'=> $users,
                ],
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        //
        return response()->json(
            [
                'status'=>false,
                'message'=>"Add user failed",
                'data'=>[
                    'users'=>null,
                ],
            ],
            404
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        $user = User::query()
            ->where('id',$id)
            ->get();
        $response = response()->json(
            [
                'status'=>false,
                'message'=>"User Not Found",
                'data'=>[
                    'users'=>null,
                ],
            ],
            404
        );
        if ($user->count()>0){
            $response = response()->json(
                [
                    'status'=>true,
                    'message'=>"Retrieved successfully.",
                    'data'=>[
                        'users'=>$user,
                    ],
                ],
                200
            );
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        //
        return response()->json(
            [
                'status'=>false,
                'message'=>"User Not Found",
                'data'=>[
                    'users'=>null,
                ],
            ],
            404
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        //
        return response()->json(
            [
                'status'=>false,
                'message'=>"User Not Found",
                'data'=>[
                    'users'=>null,
                ],
            ],
            404
        );
    }
}
