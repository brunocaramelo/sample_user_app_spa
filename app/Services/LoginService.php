<?php

namespace App\Services;

use App\Interfaces\UserInterface;
class LoginService
{
    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function doLogin(array $data) :array
    {
        if(\Auth::attempt($data) == false) {
            return [
                'status' => 'fail',
                'message' => 'Email ou senha incorretos',
            ];
        }

        $user = $this->userRepository->findByEmail($data['email'])[0];

        return [
            'status' => 'success',
            'message' => 'Login efetuado com sucesso',
            'access_token' => $user->createToken("API_TOKEN")->plainTextToken,
        ];

    }

}
