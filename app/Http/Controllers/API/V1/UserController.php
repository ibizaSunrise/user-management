<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;


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
 *     name="Retrieve Authorization Token",
 *     description="Token generation",
 * ),
 * @OA\Tag(
 *     name="Users",
 *     description="Users endpoints",
 * ),
 * @OA\Tag(
 *     name="UsersCQRS",
 *     description="Users endpoints (CSRF pattern)",
 * ),
 * @OA\Response(response=401, description="Unauthorized"),
 * @OA\Response(response=404, description="Not Found"),
 * @OA\Response(response=400, description="Bad request"),
 * @OA\Response(response=403, description="Forbidden"),
 * @OA\Response(response=422, description="The given data was invalid"),
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
     *      path="/api/user",
     *      operationId="getListOfUsers",
     *      summary="Users list",
     *      tags={"Users"},
     *      description="Get list of users",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Get list of users.",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message", type="string"),
     *              @OA\Property(property="data", type="object" ,
     *                  @OA\Property(property="users", type="array",
     *                      @OA\Items(type="object",
     *                          @OA\Property(property="id", type="integer"),
     *                          @OA\Property(property="name", type="string"),
     *                          @OA\Property(property="surname", type="string"),
     *                          @OA\Property(property="email", type="string"),
     *                          @OA\Property(property="path", type="string"),
     *                      ),
     *                  ),
     *              ),
     *          ),
     *       ),
     * )
     *
     */

    public function index(): JsonResponse
    {
        return $this->sendResponse([
            'users' => UserResource::collection(User::all()),
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/user",
     * summary="Add user",
     * description="Add user",
     * tags={"Users"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    required=true,
     *    description="Provide All Info Below",
     *    @OA\JsonContent(
     *       required={"email","password","name","surname"},
     *       @OA\Property(property="email", type="email", format="text", example="mercedes68@example.org"),
     *       @OA\Property(property="password", type="string", format="text", example="123456789"),
     *       @OA\Property(property="name", type="string", example="Anna"),
     *       @OA\Property(property="surname", type="string", example="Fox"),
     *    ),
     * ),
     * @OA\Response(
     *    response=201,
     *    description="Created",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="success"),
     *              @OA\Property(property="data", type="object" ,
     *                  @OA\Property(property="user", type="object",
     *                          @OA\Property(property="id", type="integer", example=70),
     *                          @OA\Property(property="name", type="string", example="Anna"),
     *                          @OA\Property(property="email", type="string", example="anna@gmail.com"),
     *                          @OA\Property(property="surname", type="string", example="Rutkowska"),
     *                          @OA\Property(property="updated_at", type="string", format="date-time"),
     *                          @OA\Property(property="created_at", type="string", format="date-time"),
     *                  ),
     *              ),
     *          ),
     *        )
     *     ),
     * )
     */

    public function store(UserRequest $request): JsonResponse
    {
        return $this->sendResponse([
            'user' => $this->service->makeNewUser($request->validated())
        ], ' OK', 201);
    }

    /**
     * @OA\Put(
     * path="/api/user/{id}",
     * summary="Update user",
     * description="Update user",
     * tags={"Users"},
     * @OA\Parameter(name="id", in="path", description="User id", required=true,
     *    @OA\Schema(type="integer")
     * ),
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    required=true,
     *    description="Provide All Info Below",
     *    @OA\JsonContent(
     *       required={"id"},
     *       @OA\Property(property="id", type="integer", example=70),
     *       @OA\Property(property="email", type="email", format="text", example="mercedes68@example.org"),
     *       @OA\Property(property="password", type="string", format="text", example="123456789"),
     *       @OA\Property(property="name", type="string", example="Anna"),
     *       @OA\Property(property="surname", type="string", example="Fox"),
     *    ),
     * ),
     * @OA\Response(
     *    response=201,
     *    description="Updated",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="success"),
     *              @OA\Property(property="data", type="object" ,
     *                  @OA\Property(property="user", type="object",
     *                          @OA\Property(property="id", type="integer", example=70),
     *                          @OA\Property(property="name", type="string", example="Anna"),
     *                          @OA\Property(property="email", type="string", example="anna@gmail.com"),
     *                          @OA\Property(property="surname", type="string", example="Rutkowska"),
     *                          @OA\Property(property="updated_at", type="string", format="date-time"),
     *                          @OA\Property(property="created_at", type="string", format="date-time"),
     *                  ),
     *              ),
     *          ),
     *        )
     *     ),
     * )
     */

    public function update(UserRequest $request, User $user): JsonResponse
    {
        return $this->sendResponse([
            'user' => $this->service->editUser($user, $request->validated())
        ], ' OK', 201);
    }

    /**
     * @OA\Delete(
     * path="/api/user/{id}",
     * summary="Delete user",
     * description="Delete user",
     * tags={"Users"},
     * @OA\Parameter(name="id", in="path", description="User id", required=true,
     *    @OA\Schema(type="integer")
     * ),
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=204, description="User deleted"),
     * )
     */

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAuthUser(Request $request): JsonResponse
    {
        return $this->sendResponse([
            'user' => $request->user()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handleImage(Request $request): JsonResponse
    {
        /** @var UploadedFile $image */
        $image = collect($request->files->get('images'))->first();

        return $this->sendResponse([
            'user' => new UserResource($this->service->storeImage($request->user(), $image))
        ]);
    }


}
