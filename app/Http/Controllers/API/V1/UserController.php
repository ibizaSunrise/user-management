<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



/**
 * @OA\Info(title="My API", version="0.1")
 * @OA\Schemes(format="http")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 * @OA\Tag(
 *     name="Auth",
 *     description="Auth endpoints",
 * )
 * @OA\Tag(
 *     name="Users",
 *     description="Users endpoints",
 * )
 */
class UserController extends Controller
{
    public $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     *
     * @OA\Get(
     *      path="/users",
     *      operationId="getListOfUsers",
     *      tags={"Users"},
     *      description="Get list of users",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Get list of users.",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="name", type="string"),
     *                      @OA\Property(property="surname", type="string"),
     *                      @OA\Property(property="email", type="string"),
     *                      @OA\Property(property="path", type="string"),
     *                  ),
     *              ),
     *          ),
     *       ),
     *       @OA\Response(response=401, description="Unauthorized"),
     *       @OA\Response(response=404, description="Not Found"),
     * )
     *
     * @return JsonResponse
     */

    public function index(): JsonResponse
    {
        return $this->sendResponse([
            'users' => UserResource::collection(User::all()),
        ]);
    }


    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        return $this->sendResponse([
            'user' => $this->service->makeNewUser($request->validated())
        ], ' OK', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        return $this->sendResponse([
            'user' => $this->service->editUser($user, $request->validated())
        ], ' OK', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }

    public function getAuthUser(Request $request): JsonResponse
    {
        return $this->sendResponse([
            'user' => $request->user()
        ]);
    }

    public function handleImage(Request $request): JsonResponse
    {
        /** @var UploadedFile $image */
        $image = collect($request->files->get('images'))->first();

        return $this->sendResponse([
            'user' => new UserResource($this->service->storeImage($request->user(), $image))
        ]);
    }


}
