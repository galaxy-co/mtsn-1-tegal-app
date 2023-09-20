<?php

namespace App\Controllers;
use App\Controllers\BaseController; 
use App\Models\Admin\UserModel;

class AuthController extends BaseController
{
   

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index(): string
    {
        return view('login');
    }

    public function login(){
        return view('login');
    }

    public function loginPost(){
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getPost('password');
        
        $data = $this->userModel->where('username', $username)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['user_id'],
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'role_id' => $data['role_id'],
                    'isLoggedIn' => TRUE,
                ];
                $session->set($ses_data);
                if($data['role_id'] == 1){
                    return redirect()->to('/admin');
                }else if($data['role_id'] == 2){
                    return redirect()->to('/siswa');
                }else{
                    return redirect()->to('/kamad');
                }
                
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/signin');
            }
        }else{
            $session->setFlashdata('msg', 'Username does not exist.');
            return redirect()->to('/signin');
        }
    }

    
}
