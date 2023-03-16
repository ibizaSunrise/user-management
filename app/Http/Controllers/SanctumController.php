<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use Illuminate\Http\Request;
use OpenApi\Generator;


class SanctumController extends Controller
{
    /**
     * @OA\Post(path="/api/getToken ", tags={"Retrieve Authorization Token"},
     *   summary="Post your email and password and we will return a token. Use the token in the 'Authorization' header like so 'Bearer YOUR_TOKEN'",
     *   operationId="",
     *   description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="The Token Request",
     *       @OA\JsonContent(
     *        @OA\Property(property="email",type="string",example="test@gmail.com"),
     *        @OA\Property(property="password",type="string",example="testtesttest"),
     *       )
     *   ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=422, description="The provided credentials are incorrect.")
     * )
     */
    public function create(TokenRequest $request)
    {
        return $request->generate();
    }
}
