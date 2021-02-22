<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class DateInPastCheck implements Rule
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

            // "02/22/2021 - 02/27/2021" 

            $dates = explode('-', $value);

            if(Carbon::createFromFormat('m/d/Y', str_replace(' ', '' , $dates[0]))->isPast() && Carbon::createFromFormat('m/d/Y', str_replace(' ', '', $dates[1]))->isPast()){
                return false;
            }

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
        return 'Please choose valid dates.';
    }
}
