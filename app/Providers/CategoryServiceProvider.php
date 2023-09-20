<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Define the 'greater_than_or_equal' validation rule
        Validator::extend('greater_than_or_equal', function ($attribute, $value, $parameters, $validator) {
            $minValue = $parameters[0];
            return $value >= $minValue; // Changed to greater than or equal
        });

        // Customize the error message for the 'greater_than_or_equal' rule
        Validator::replacer('greater_than_or_equal', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':min', $parameters[0], $message);
        });
    }
}


