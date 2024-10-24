<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Http\RedirectResponse;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function index()
    {
        $teachers = $this->teacherService->getAllTeachers();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        $this->teacherService->createTeacher($request->validated());
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully');
    }

    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        $this->teacherService->updateTeacher($teacher, $request->validated());
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        $this->teacherService->deleteTeacher($teacher);
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully');
    }
}
