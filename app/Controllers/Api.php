<?php

namespace App\Controllers;

use App\Models\SubscriberModel;

class Api extends BaseController
{
    public function subscribe()
    {
        $email = $this->request->getPost('email');
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'status'  => 'error',
                'message' => 'Email tidak valid',
            ])->setStatusCode(400);
        }

        $model = new SubscriberModel();
        try {
            $model->insert([
                'email'      => $email,
                'status'     => 'subscribed',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => true,
                'status'  => 'ok',
                'message' => 'Email sudah terdaftar',
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'status'  => 'ok',
            'message' => 'Terima kasih telah berlangganan',
        ]);
    }

    public function submitContact()
    {
        $data = [
            'name'       => trim((string) $this->request->getPost('name')),
            'email'      => trim((string) $this->request->getPost('email')),
            'phone'      => trim((string) $this->request->getPost('phone')),
            'subject'    => trim((string) $this->request->getPost('subject')),
            'message'    => trim((string) $this->request->getPost('message')),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($data['name'] === '' || $data['email'] === '' || $data['message'] === '') {
            return $this->response->setJSON([
                'success' => false,
                'status'  => 'error',
                'message' => 'Nama, email, dan pesan wajib diisi',
            ])->setStatusCode(400);
        }

        if (! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'status'  => 'error',
                'message' => 'Email tidak valid',
            ])->setStatusCode(400);
        }

        $model = new \App\Models\ContactModel();
        $model->insert($data);

        return $this->response->setJSON([
            'success' => true,
            'status'  => 'ok',
            'message' => 'Pesan berhasil dikirim',
        ]);
    }
}
