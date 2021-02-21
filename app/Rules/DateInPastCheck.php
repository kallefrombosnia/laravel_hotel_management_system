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

            $dates = explode('-', $value);

            return Carbon::createFromFormat('m/d/Y', trim($dates[0], '\n'))->isPast() && Carbon::createFromFormat('m/d/Y', trim($dates[1], '\n'))->isPast();
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
