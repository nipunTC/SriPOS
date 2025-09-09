<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        //if user is already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        //if user remember me cookie is set, log them in automatically
        if (isset($_COOKIE['remember_me'])) {
            $userModel = new UserModel();
            $user = $userModel->find($_COOKIE['remember_me']);
            if ($user) {
                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'userRole'  => $user['role'],
                    'name'      => $user['name'],
                    'isLoggedIn'=> true
                ]);
                return redirect()->to('/dashboard');
            }
        }
        // set page title
        $data['title'] = 'Login - SriPOS';
        return view('dashboard/signup',$data);
    }
    
    public function logins()
    {
        $session   = session();
        $userModel = new UserModel();

        $usernameOrEmail = $this->request->getPost('username');
        $password        = $this->request->getPost('password');
        $remember        = $this->request->getPost('rememberMe');

        $user = $userModel->where('username', $usernameOrEmail)->orWhere('email', $usernameOrEmail)->first();
    
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'userRole'  => $user['role'],
                'name'      => $user['name'],
                'isLoggedIn'=> true
            ]);

            // update last login
            $userModel->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
            
            // remember me (improve later with secure token)
            if ($remember) {
                setcookie('remember_me', $user['id'], time() + (86400 * 30), "/", "", true, true);
            }

            // check birthday
            $today        = date('m-d');
            $userBirthday = date('m-d', strtotime($user['birthday']));
            if ($userBirthday == $today) {
                $session->setFlashdata('birthday_message', 'Happy Birthday, ' . $user['name'] . '!');
            }
            return redirect()->to('/dashboard');
            
        }else {
            $session->setFlashdata('error', 'Invalid username or password.');
            return redirect()->to('/signup')->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        setcookie('remember_me', '', time() - 3600, "/", "", true, true); // delete cookie
        return redirect()->to('/login');
    }
}
