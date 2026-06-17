<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        // Check if user is logged in
        if (!$this->session->has('user_id')) {
            return redirect()->to('auth/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $data = [
            'title'            => 'Dashboard',
            'user_name'        => $this->session->get('user_name'),
            'user_email'       => $this->session->get('user_email'),
        ];

        return view('dashboard/index', $data);
    }

    // Palm Oil Management Dashboard
    public function palmOilIndex()
    {
        $data = [
            'title' => 'Palm Oil Dashboard'
        ];
        return view('dashboard/palm-dashboard-main', $data);
    }

    public function tbsManagement()
    {
        $data = [
            'title' => 'TBS Management'
        ];
        return view('dashboard/tbs-management', $data);
    }

    public function productionRecords()
    {
        $data = [
            'title' => 'Production Records'
        ];
        return view('dashboard/production-records', $data);
    }

    public function harvestingRecords()
    {
        $data = [
            'title' => 'Harvesting Records'
        ];
        return view('dashboard/harvesting-records', $data);
    }

    public function farmSettings()
    {
        $data = [
            'title' => 'Farm Settings'
        ];
        return view('dashboard/farm-settings', $data);
    }

    public function analytics()
    {
        $data = [
            'title' => 'Analytics & Reporting'
        ];
        return view('dashboard/analytics', $data);
    }

    public function apiReference()
    {
        $data = [
            'title' => 'API Reference'
        ];
        return view('dashboard/api-reference', $data);
    }
}
