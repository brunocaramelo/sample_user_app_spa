<?php

namespace App\Services;

use App\Interfaces\UserInterface;

use App\Events\{UserCreated,
                UserRememberPassword};

use App\Exceptions\UserNotFoundException;
class AuthService
{
    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function searchUsers(array $data)
    {
        return $this->userRepository->searchPaginate($data);
    }

    public function doRegisterUser(array $data) :array
    {
        $data['password'] = bcrypt($data['password']);

        $user = $this->userRepository->create($data);

        event(new UserCreated($user));

        return [
            'status' => 'success',
            'message' => 'Registro efetivado com sucesso',
        ];

    }
    public function doRememberPassword($email) :array
    {
        $data['password'] = bcrypt(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -5));

        $userInst = $this->userRepository->findByEmail($email)[0] ?? null;

        if (($userInst->id ?? null) == null) {
            throw new UserNotFoundException('Email não localizado');
        }

        $this->userRepository->update($data, $userInst->id);

        event(new UserRememberPassword($userInst, $data['password']));

        return [
            'status' => 'success',
            'message' => 'Nova senha enviada com sucesso',
        ];

    }

}
