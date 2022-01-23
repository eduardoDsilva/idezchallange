<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserAccountType implements Rule
{

    private $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->type = !empty($_POST['type']) ? $_POST['type'] : "";
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = DB::table('accounts')
            ->where('type', '=', $this->type)
            ->where('user_id', '=', $value)
            ->get();
        if (count($user)>0){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "This user already has an Account {$this->type}.";
    }
}
