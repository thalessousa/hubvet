<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserServiceInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $service;

    /**
     * Method __construct
     *
     * @param UserServiceInterface $service
     *
     * @return void
     */
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(UserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return response()->json(null, 201);
    }

    public function show(UserRequest $request, User $user): JsonResponse
    {
        return response()->json(new UserResource($this->service->find($user)));
    }

    public function destroy(UserRequest $request, User $user): Response
    {
        $this->service->delete($user);
        return response(null, 204);
    }
    
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('name', 'password');
 
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('sector');
        }
    }
}