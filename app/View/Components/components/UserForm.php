<?php

namespace App\View\Components\components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserForm extends Component
{
    public ?User $user;

    /**
     * Create a new component instance.
     */
    public function __construct(?User $user = null)
    {
        // Si aucun utilisateur n'est fourni, créer un nouvel utilisateur
        $this->user = $user ?? new User();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-form', ['user' => $this->user]);
    }
}
