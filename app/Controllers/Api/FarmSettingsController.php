<?php

namespace App\Controllers\Api;

use App\Models\FarmSettingsModel;
use CodeIgniter\RESTful\ResourceController;

class FarmSettingsController extends ResourceController
{
    protected $modelName = FarmSettingsModel::class;
    protected $format = 'json';

    public function index()
    {
        $farmId = (int) $this->request->getVar('farm_id');
        if (!$farmId) {
            return $this->fail('Farm ID is required', 400);
        }

        $settings = $this->model->where('farm_id', $farmId)->first();
        if (!$settings) {
            return $this->failNotFound('Settings not found');
        }

        return $this->respond(['success' => true, 'data' => $settings]);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $this->model->insert($data);
        return $this->respondCreated(['success' => true, 'id' => $this->model->getInsertID()]);
    }

    public function update($id = null)
    {
        $settings = $this->model->find($id);
        if (!$settings) {
            return $this->failNotFound('Settings not found');
        }

        $data = $this->request->getJSON(true);
        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $this->model->update($id, $data);
        return $this->respond(['success' => true, 'message' => 'Settings updated']);
    }
}
