<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    private function student_data()
    {
        return [
            'student_id' => 'MCC2022-0253',
            'name' => 'John Francis Torres',
            'course' => 'BS Information Technology',
            'year' => '3rd Year',
            'section' => '3F3',
            'email' => 'Johnfrancistorres12@gmail.com',
            'location' => 'Oriental Mindoro, Philippines',
            'interests' => 'Online games, Anime, and Runnning',
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