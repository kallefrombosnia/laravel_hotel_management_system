<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class DateArrivalLeaveCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if($value){

            $dates = explode('-', $value);

            $arrival = Carbon::createFromFormat('m/d/Y', str_replace(' ', '' , $dates[0]));

            $leave = Carbon::createFromFormat('m/d/Y', str_replace(' ', '' , $dates[1]));

            if(!$arrival->gt($leave)){
                return true;
            }

            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Leave cannot be before arrival.';
    }
}
