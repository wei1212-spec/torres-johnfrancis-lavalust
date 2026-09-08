<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function login()
    {
        if (!empty($_SESSION['authenticated_user'])) {
            redirect('products');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->call->model('UsersModel');
            $username = trim((string) $this->call->request->post('username'));
            $password = (string) $this->call->request->post('password');
            $user = UsersModel::find_by('username', $username);

            if ($user && !empty($user['is_active']) && password_verify($password, $user['password'])) {
                $this->call->session->sess_regenerate(true);
                $this->call->session->set_userdata('authenticated_user', [
                    'id' => $user['id'],
                    'username' => $user['username'],
                ]);
                redirect('products');
            }

            $error = 'The username or password is incorrect.';
        }

        $this->call->view('login', ['error' => $error]);
    }

    public function logout()
    {
        $this->call->session->unset_userdata('authenticated_user');
        redirect('login');
    }
}