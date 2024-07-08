<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\DTOs\UserDTO;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of students.
     */
    public function showStudents(): View
    {
        $userId = auth()->user()->id;
        $students = $this->userService->getAllStudentsExcept($userId);

        return view('user.students', compact('students'));
    }

        /**
     * Display a listing of teachers.
     */
    public function showTeachers(): View
    {
        $userId = auth()->user()->id;
        $teachers = $this->userService->getAllTeachersExcept($userId);
        return view('user.teachers', compact('teachers'));
    }
}
