<?php

namespace App\Http\Resources;

use App\Http\Resources\AcademicProgramCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicLevelResource extends JsonResource
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
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by_id' => $this->created_by_id,
            'deleted_by_id' => $this->deleted_by_id,
            'academicPrograms' => $this->whenLoaded(
                relationship: 'academicPrograms',
                value: fn(): AcademicProgramCollection => new AcademicProgramCollection($this->academicPrograms),
                default: []
            ),
            'academicProgramLevels' => $this->whenLoaded(
                relationship: 'academicProgramLevels',
                value: fn() => $this->academicProgramLevels,
                default: []
            ),
        ];
    }
}