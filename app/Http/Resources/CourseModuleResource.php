<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseModuleResource extends JsonResource
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
            'academicProgramLevel' => $this->whenLoaded(
                relationship: 'academicProgramLevel',
                value: fn()  => $this->academicProgramLevel,
                default: null
            ),
            'createdBy' =>
            $this->whenLoaded(
                relationship: 'createdBy',
                value: fn()  => $this->createdBy,
                default: null
            ),
            'deletedBy' =>
            $this->whenLoaded(
                relationship: 'createdBy',
                value: fn()  => $this->deletedBy,
                default: null
            ),
            'course_id' => $this->course_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
