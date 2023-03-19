<?php

namespace App\Http\Controllers\API\V2;

use App\CQRS\User\Delete\DeleteUserCommand;
use App\CQRS\User\List\ListUserCommand;
use App\CQRS\User\Store\StoreUserCommand;
use App\CQRS\User\Update\UpdateUserCommand;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends CQRSController
{
    /**
     *
     * @OA\Get(
     *      path="/api/v2/user",
     *      operationId="getListOfUsersCQRS",
     *      summary="Users list",
     *      tags={"UsersCQRS"},
     *      description="Get list of users CQRS",
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
            'users' => $this->getBus()->handle(new ListUserCommand)
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/v2/user",
     * summary="Add user",
     * description="Add user",
     * tags={"UsersCQRS"},
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
        $command = new StoreUserCommand(
            $request->post('name'),
            $request->post('surname'),
            $request->post('email'),
            $request->post('password'),
        );

        return $this->sendResponse(
            ['user' => $this->getBus()->handle($command)], ' OK', 201
        );
    }

    /**
     * @OA\Put(
     * path="/api/v2/user/{id}",
     * summary="Update user",
     * description="Update user",
     * tags={"UsersCQRS"},
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
    public function update(UserRequest $request, $id): JsonResponse
    {
        $command = new UpdateUserCommand(
            $id,
            $request->post('name'),
            $request->post('surname'),
            $request->post('email'),
            $request->post('password'),
        );

        return $this->sendResponse(
            ['user' => $this->getBus()->handle($command)]
        );

    }

    /**
     * @OA\Delete(
     * path="/api/v2/user/{id}",
     * summary="Delete user",
     * description="Delete user",
     * tags={"UsersCQRS"},
     * @OA\Parameter(name="id", in="path", description="User id", required=true,
     *    @OA\Schema(type="integer")
     * ),
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=204, description="User deleted"),
     * )
     */
    public function destroy($id): Response
    {

        $this->getBus()->handle(new DeleteUserCommand($id));
        return response()->noContent();
    }
}
