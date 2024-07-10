<?php

namespace App\Repositories;

use App\Models\{User, Person};
use App\Interfaces\UserInterface;

class UserRepository implements UserInterface
{    private $model = User::class;

    public function searchPaginate(array $filters)
    {
        return $this->model::with(['person'])
                ->when(!empty($filters['name']), function ($query) use ($filters) {
                    $query->where('name', 'LIKE' ,'%'.$filters['name'].'%');
                })
                ->when(!empty($filters['email']), function ($query) use ($filters) {
                    $query->where('email', 'LIKE' ,'%'.$filters['email'].'%');
                })
                ->paginate($filters['page_limit'] ?? 10);
    }
    public function findByEmail(string $email)
    {
        return $this->model::where('email', $email)
                ->get();
    }

    public function update(array $data, $id)
    {
        return User::find($id)->update($data);
    }

    public function create(array $data)
    {
        $user = User::create($data);

        $person = $user->person()->create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'cep' => $data['cep'],
            'street' => $data['street'],
            'city' => $data['city'],
            'street_number' => $data['street_number'],
            'state' => $data['state'],
            'neighborhood' => $data['neighborhood'],
        ]);

        $user->person_id = $person->id;

        $user->save();

        return $user;
    }
}
