<?php

namespace App\Services;

use Illuminate\Support\Facades\Password;


class PasswordResetLinkService
{
    /**
     * Create a new class PasswordResetLinkService.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of store
     * @param array<string, string> $credentials
     * @return string
     */
    public function store(array $credentials): string
    {
        return Password::sendResetLink(
            credentials: $credentials
        );
    }
}
