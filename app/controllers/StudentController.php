<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    private function student_data()
    {
        return [
            'student_id' => '2026-1842',
            'name' => 'Alexis Rivera',
            'course' => 'BS Information Technology',
            'year' => '2nd Year',
            'section' => 'Web Systems - B',
            'email' => 'alexis.rivera@example.com',
            'location' => 'Manila, Philippines',
            'interests' => 'Interface design, PHP, and digital illustration',
        ];
    }

    public function index()
    {
        $_SESSION['student_access'] = true;
        $this->call->view('student_home', ['student' => $this->student_data()]);
    }

    public function profile()
    {
        $this->call->view('student_profile', ['student' => $this->student_data()]);
    }
}