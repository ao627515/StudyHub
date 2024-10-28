<?php

namespace App\Services;

use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherService
{
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function createTeacher(array $data)
    {
        $attibutes = $data;
        $attibutes['created_by_id'] = Auth::id();

        return Teacher::create($attibutes);
    }

    public function updateTeacher(Teacher $teacher, array $data)
    {
        $teacher->update($data);
        return $teacher;
    }

    public function deleteTeacher(Teacher $teacher)
    {
        $this->updateTeacher($teacher, ['deleted_by_id' => Auth::id()]);

        $teacher->delete();
    }
}