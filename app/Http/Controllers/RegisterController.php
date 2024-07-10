<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

use App\Http\Requests\{RegisterFormRequest,
                       PasswordRememberRequest};

use App\Exceptions\{CepNotFoundException,
                    UserNotFoundException};

use App\Consumers\CepFinderConsumer;
class RegisterController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function findLocationByCep(CepFinderConsumer $client, $cep)
    {
        try {

            return response()->json([
                'message' => 'Usuario registrado com sucesso',
                'data' => $client->find($cep)
              ], 200);

        } catch (CepNotFoundException $error) {

            return response()->json([
                'message' => $error->getMessage(),
              ], 400);

        }
    }
    public function doRegister(RegisterFormRequest $request, CepFinderConsumer $clientCep)
    {
        try {
            $clientCep->find($request->cep);

            $this->authService->doRegisterUser($request->validated());

            return response()->json([
                'message' => 'Usuario registrado com sucesso'
            ], 200);
        } catch (CepNotFoundException $error) {

            return response()->json([
                'message' => $error->getMessage(),
              ], 400);

        }
    }
    public function doRememberPassword(PasswordRememberRequest $request)
    {
        try {

            $this->authService->doRememberPassword($request->email);

            return response()->json([
                'message' => 'Voce recebar sua nova senha por email em breve'
            ], 200);
        } catch (UserNotFoundException $error) {

            return response()->json([
                'message' => $error->getMessage(),
              ], 400);
        }
    }

}
