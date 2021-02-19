<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\UsersInterface;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    protected $userRepository;

    public function __construct(UsersInterface $userRepository)
    {
        $this->UserRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll($this->UserRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->UserRepository->store($request, new User());

        if ($response['success'] === true) {
            return $this->showOne($response['user'], $response['code']);
        } else {
           return $this->errorResponse($response['message'], $response['code']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $response = $this->UserRepository->show($user);

        return $this->showOne($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $response = $this->UserRepository->update($request, $user);

        if ($response['success']) {
            return $this->showOne($response['user'], $response['code']);
        } else {
            return $this->errorResponse($response['message'], $response['code']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $response = $this->UserRepository->destroy($user);

        if ($response['code'] === 200) {
            return $this->showMessage($response['message']);
        }else {
            return $this->errorResponse($response['message'], $response['code']);
        }

    }
}
