<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


class StudentController extends Controller
{
    
    private $student = [
        'student_id'  => 'MCC2022-0253', 
        'name'        => 'Torres, John Francis R.',
        'course'      => 'BSIT',
        'year'        => '3rd Year',
        'section'     => '3-F3',
        'email'       => 'johnfrancistorres12@gmail.com',
        'address'     => 'Naujan',
        'contact'     => '09543221675',
        'skills'      => 'PHP, JavaScript, UI Design',
        'bio'         => '"Dare to Dream, Dare to Learn!" , "Curiosity Fuels Wisdom!" ,"From Aspiration to Graduation!"',
    ];

  
    public function index()
    {
       
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['profile_access'] = true;

        $data['name'] = $this->student['name'];
        $data['denied'] = isset($_GET['denied']);

        $this->call->view('student_home', $data);
    }

    
    public function profile()
    {
        $this->call->view('student_profile', $this->student);
    }
}
