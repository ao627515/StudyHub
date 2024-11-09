<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\AcademicProgramResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AcademicProgramCollection;
use App\Http\Resources\AcademicProgramLevelCollection;

class AcademicProgramLevelResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by_id' => $this->created_by_id,
            'deleted_by_id' => $this->deleted_by_id,
            'academicProgram' => $this->whenLoaded(
                relationship: 'academicPrograms',
                value: fn(): AcademicProgramResource => new AcademicProgramResource($this->academicProgram),
                default: $this->academic_program_id
            ),
            'academicLevel' => $this->whenLoaded(
                relationship: 'academicLevels',
                value: fn(): AcademicLevelResource => new AcademicLevelResource($this->academicLevel),
                default: []
            ),
        ];
    }
}
