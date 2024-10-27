<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResponseResource extends JsonResource
{
    protected string $message;

    /**
     * Détails des erreurs associées à la réponse.
     *
     * @var array<string, mixed>|null
     * Clés possibles :
     * - 'exception' : Message d'exception (string)
     * - 'validation' : Détails de validation échouée (array|null)
     */
    protected ?array $errors;

    /**
     * Initialise la ressource avec un message personnalisé et des détails d'erreur.
     *
     * @param mixed $resource
     * @param string $message
     * @param array<string, mixed>|null $errors
     */
    public function __construct(string $message = 'Operation failed', ?array $errors = null)
    {
        parent::__construct(null);
        $this->message = $message;
        $this->errors = $errors;
    }

    /**
     * Transforme la ressource en tableau.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'error',
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
