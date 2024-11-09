<?php

namespace App\Http\Resources;

use App\Http\Resources\AcademicProgramCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UniversityResource extends JsonResource
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
            'logo' => $this->logo,
            'abb' => $this->abb,
            'academicPrograms' => $this->whenLoaded(
                relationship: 'academicPrograms',
                value: function () {
                    return new AcademicProgramCollection($this->academicPrograms);
                },
                default: []
            ),
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by_id' => $this->created_by_id,
            'deleted_by_id' => $this->deleted_by_id

        ];
    }
}