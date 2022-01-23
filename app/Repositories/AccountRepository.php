<?php

namespace App\Repositories;

use App\Account;

class AccountRepository
{
    public function saveAccount($data)
    {
        $data = $this->prepareToInsert($data);
        Account::create($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function prepareToInsert($data)
    {
        $data['document'] = preg_replace('/[^0-9]/', '', $data['document']);
        if ($data['type'] == 'Person') {
            unset($data['social_reason']);
        }
        return $data;
    }
}
