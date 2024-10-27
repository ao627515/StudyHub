<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UniversityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'abb' => $this->abb,
            'university' => $this->whenLoaded(
                relationship: 'university',
                value: fn(): UniversityResource => new UniversityResource(resource: $this->university),
                default: null
            ),
            'academicProgramLevels' => $this->whenLoaded(
                relationship: 'academicProgramLevels',
                value: fn() => $this->academicLevels,
                default: []
            ),
            'academicLevels' => $this->whenLoaded(
                relationship: 'academicLevels',
                value: fn() => $this->academicLevels,
                default: []
            )
        ];
    }
}
