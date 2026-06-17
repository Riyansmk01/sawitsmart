<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session   = session();
    }

    public function login()
    {
        // Redirect jika sudah login
        if ($this->session->has('user_id')) {
            return redirect()->to('dashboard');
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->userModel->getUserByEmail($email);

            if (!$user) {
                return redirect()->back()->with('error', 'Email tidak ditemukan');
            }

            if (!$this->userModel->verifyPassword($password, $user['password'])) {
                return redirect()->back()->with('error', 'Password salah');
            }

            $sessionData = [
                'user_id'    => $user['id'],
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'logged_in'  => true,
            ];
            $this->session->set($sessionData);

            return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $user['name']);
        }

        return view('auth/login');
    }

    public function register()
    {
        // Redirect jika sudah login
        if ($this->session->has('user_id')) {
            return redirect()->to('dashboard');
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            $data = [
                'name'               => $this->request->getPost('name'),
                'email'              => $this->request->getPost('email'),
                'password'           => $this->request->getPost('password'),
                'phone'              => $this->request->getPost('phone'),
                'organization'       => $this->request->getPost('organization'),
                'organization_type'  => $this->request->getPost('organization_type'),
            ];

            // Validasi password confirmation
            $passwordConfirm = $this->request->getPost('password_confirm');
            if ($data['password'] !== $passwordConfirm) {
                return redirect()->back()->with('error', 'Password tidak cocok');
            }

            if (!$this->userModel->createUser($data)) {
                $errors = $this->userModel->errors();
                return redirect()->back()->withInput()->with('errors', $errors);
            }

            // Get user yang baru dibuat
            $user = $this->userModel->getUserByEmail($data['email']);

            // Set session
            $this->session->set([
                'user_id'    => $user['id'],
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'logged_in'  => true,
            ]);

            return redirect()->to('dashboard')->with('success', 'Akun berhasil dibuat. Selamat datang!');
        }

        return view('auth/register');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Anda telah logout');
    }
}
