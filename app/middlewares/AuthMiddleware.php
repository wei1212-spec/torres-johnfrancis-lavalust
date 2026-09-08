<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        if (!empty($_SESSION['authenticated_user'])) {
            return $next();
        }

        redirect('login', false, false);
        return false;
    }
}