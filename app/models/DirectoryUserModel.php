<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * DirectoryUserModel
 *
 * Represents the profile directory table supplied by the application database.
 */
class DirectoryUserModel extends Model
{
    protected $table = 'user';

    protected $primary_key = 'id';
}
