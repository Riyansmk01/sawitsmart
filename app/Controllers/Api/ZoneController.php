<?php

namespace App\Controllers\Api;

use App\Models\ZoneModel;
use CodeIgniter\API\ResponseTrait;

class ZoneController extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new ZoneModel();
    }

    // GET /api/zones - List zones by farm
    public function index()
    {
        $farmId = $this->request->getVar('farm_id');

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        $zones = $this->model->where('farm_id', $farmId)
            ->orderBy('zone_code', 'ASC')
            ->findAll();

        return $this->respond([
            'success' => true,
            'data' => $zones,
            'count' => count($zones)
        ]);
    }

    // POST /api/zones - Create new zone
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $id = $this->model->insert($data);

        return $this->respondCreated([
            'success' => true,
            'message' => 'Zone created',
            'data' => $this->model->find($id)
        ]);
    }

    // GET /api/zones/:id - Get single zone
    public function show($id)
    {
        $zone = $this->model->find($id);

        if (!$zone) {
            return $this->failNotFound('Zone not found');
        }

        return $this->respond([
            'success' => true,
            'data' => $zone
        ]);
    }

    // PUT /api/zones/:id - Update zone
    public function update($id)
    {
        $zone = $this->model->find($id);

        if (!$zone) {
            return $this->failNotFound('Zone not found');
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $this->model->update($id, $data);

        return $this->respond([
            'success' => true,
            'message' => 'Zone updated',
            'data' => $this->model->find($id)
        ]);
    }

    // DELETE /api/zones/:id - Delete zone
    public function delete($id)
    {
        $zone = $this->model->find($id);

        if (!$zone) {
            return $this->failNotFound('Zone not found');
        }

        $this->model->delete($id);

        return $this->respond([
            'success' => true,
            'message' => 'Zone deleted'
        ]);
    }
}
