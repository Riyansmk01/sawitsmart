<?php

namespace App\Controllers;

use App\Models\ContactModel;

class Contact extends BaseController
{
    public function index()
    {
        return view('public/kontak');
    }

    public function submit()
    {
        $model = new ContactModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $model->insert($data);
        return redirect()->to(site_url('kontak'))->with('success', 'Pesan terkirim.');
    }
}
