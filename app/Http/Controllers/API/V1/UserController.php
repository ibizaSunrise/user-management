<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
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
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): \Illuminate\Http\Response
    {
        $user->delete();

        return response()->noContent();
    }

    public function getAuthUser()
    {
        return Auth::user();
    }

    public function handleImage(Request $request)
    {

        $data = $request->validate([
            'images' => 'nullable|array',
        ]);


        $images = $data['images'];
        $image = $images[0];
//        unset($data['images']);

        //first image save to db

        $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        $user = Auth::user();

        $user->update([
            'path' => url('/storage/'.$filePath)
        ]);

        return response()->noContent();


    }


}
