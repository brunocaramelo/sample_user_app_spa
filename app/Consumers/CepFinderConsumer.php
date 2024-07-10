<?php

namespace App\Consumers;

use Illuminate\Support\Facades\Http;

use App\Exceptions\CepNotFoundException;
class CepFinderConsumer
{

    public function __construct()
    {
    }

    public function find(string $cep)
    {
        try {

            $cepFill = str_replace([' ','-'],['',''], $cep);

            $responseApi = Http::get('https://viacep.com.br/ws/' . $cepFill . '/json/');

            return [
                'cep' => $cepFill,
                'street' => $responseApi['logradouro'],
                'city' => $responseApi['localidade'],
                'state'=> $responseApi['uf'],
                'neighborhood'=> $responseApi['bairro'],
            ];

        } catch (\Exception $e) {
            throw new CepNotFoundException("CEP não encontrado");
        }
    }
}
