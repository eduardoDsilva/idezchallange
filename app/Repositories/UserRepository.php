<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function saveUser($data)
    {
        $data = $this->prepareToInsert($data);
        User::create($data);
    }

    public function getUsers($request)
    {
        if (!empty($request->input('q'))) {
            $users = User::where('name', 'like', "{$request->input('q')}%")
                ->orWhere('document', '=', $request->input('q'))
                ->get();
        } else {
            $users = User::all();
        }
        return $users;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function prepareToInsert($data)
    {
        $data['document'] = preg_replace('/[^0-9]/', '', $data['document']);
        $data['phone_number'] = preg_replace('/[^0-9]/', '', $data['phone_number']);
        $data['password'] = Hash::make($data['password']);
        return $data;
    }
}
