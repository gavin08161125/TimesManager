<?php

namespace App\Http\Controllers;

use App\Authority;
use Illuminate\Http\Request;

class AuthorityController extends Controller
{
    public function index()
        {
            $authorities = Authority::get();
            return  $authorities;
        }
}
