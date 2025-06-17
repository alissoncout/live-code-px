<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($data)
    {
        $user = $this->userRepository->getByEmail($data->email);

        if($user){
            return array("message" => "Já existe um usuário cadastrado com esse e-mail 😥", "status" => false);
        }

        $data = $data->input();
        $data['password'] = bcrypt($data['password']);
        $data['email'] = strtolower( $data['email']);
        
        $user = $this->userRepository->create($data);

        $user->access_token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return array("data" => new UserResource($user), "status" => true);
    }

    public function login($data)
    {
        $user = $this->userRepository->getByEmail($data->email);

        if (!$user || !Hash::check($data->password, $user->password)) {
            return array("message" => "E-mail ou senha incorretos", "status" => false);
        }

        $user->access_token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return array("data" => new UserResource($user), "status" => true);
    }

    public function validateToken($request){
        return array("message" => "Valid token", "data" => ["id_user" => $request->user()->id], "status" => true);
    }

    public function logout($request)
    {
        $request->user()->tokens()->delete();

        return array("message" => "Logged out", "data"=> array(), "status" => true);
    }

    public function me($request)
    {
        return array("data" => new UserResource($request->user()), "status" => true);
    }
}