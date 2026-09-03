<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
    public function index()
    {
        $users = UsersModel::all();
        $this->call->view('users', ['users' => $users]);
    }
}