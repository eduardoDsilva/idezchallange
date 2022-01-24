<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TransactionAccountType implements Rule
{

    private $account_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->account_id = !empty($_POST['account_id']) ? $_POST['account_id'] : "";
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $account_id = DB::table('users')
            ->where('id', '=', (DB::table('accounts')->select('user_id')->where('id', '=', $this->account_id)->first()->user_id))
            ->first();
        if (Hash::check($value, $account_id->password)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Incorrect account password.";
    }
}
