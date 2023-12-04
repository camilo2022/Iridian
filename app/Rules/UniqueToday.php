<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Contact; // Asegúrate de importar el modelo correcto

class UniqueToday implements Rule
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
        $email = request('email');

        return !Contact::where('email', $email)
            ->whereDate('created_at', now()->toDateString())
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya has enviado un mensaje hoy.';
    }
}
