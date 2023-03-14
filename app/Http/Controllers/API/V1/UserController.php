<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;


class UserController extends Controller
{
    public $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        return UserResource::collection(User::all());
    }


    /**
     * @param UserRequest $request
     * @return UserResource
     */
    public function store(UserRequest $request): UserResource
    {

        $data = $request->validated();
        $user = $this->service->makeNewUser($data);
        return new UserResource($user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return UserResource
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        $data = $request->validated();
        $user = $this->service->editUser($data, $user);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): \Illuminate\Http\Response
    {
        $user->delete();

        return response()->noContent();
    }
}
