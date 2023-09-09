<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    // public function index(): string
    // {
    //     return view('admin/index');
    // }

    public function login(){
        return view('login');
    }

    public function loginPost(){
        dd($this->request->getPost());
    }
}
