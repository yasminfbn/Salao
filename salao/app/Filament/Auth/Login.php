<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    public function getHeading(): string
    {
        return 'Bem-vinda ao Glam House';
    }

    public function getSubHeading(): ?string
    {
        return 'Entre para acessar o sistema.';
    }
}