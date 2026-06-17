<?php

namespace App\Controllers\Api;

use App\Models\FarmModel;
use CodeIgniter\API\ResponseTrait;

class FarmController extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new FarmModel();
    }

    // GET /api/farms - List all farms
    public function index()
    {
        $page = (int) ($this->request->getVar('page') ?? 1);
        $perPage = (int) ($this->request->getVar('per_page') ?? 20);
        $status = $this->request->getVar('status');

        $query = $this->model;

        if ($status) {
            $query = $query->where('status', $status);
        }

        $total = $query->countAllResults(false);
        $farms = $query->paginate($perPage, 'default', $page);

        return $this->respond([
            'success' => true,
            'data' => $farms,
            'pagination' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'total_pages' => ceil($total / $perPage)
            ]
        ]);
    }

    // POST /api/farms - Create farm
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $id = $this->model->insert($data);

        return $this->respondCreated([
            'success' => true,
            'message' => 'Farm created',
            'data' => $this->model->find($id)
        ]);
    }

    // GET /api/farms/:id - Get single farm
    public function show($id)
    {
        $farm = $this->model->find($id);

        if (!$farm) {
            return $this->failNotFound('Farm not found');
        }

        return $this->respond([
            'success' => true,
            'data' => $farm
        ]);
    }

    // PUT /api/farms/:id - Update farm
    public function update($id)
    {
        $farm = $this->model->find($id);

        if (!$farm) {
            return $this->failNotFound('Farm not found');
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $this->model->update($id, $data);

        return $this->respond([
            'success' => true,
            'message' => 'Farm updated',
            'data' => $this->model->find($id)
        ]);
    }

    // DELETE /api/farms/:id - Delete farm
    public function delete($id)
    {
        $farm = $this->model->find($id);

        if (!$farm) {
            return $this->failNotFound('Farm not found');
        }

        $this->model->delete($id);

        return $this->respond([
            'success' => true,
            'message' => 'Farm deleted'
        ]);
    }

    // GET /api/farms/:id/summary - Get farm summary
    public function summary($id)
    {
        $farm = $this->model->find($id);

        if (!$farm) {
            return $this->failNotFound('Farm not found');
        }

        $db = \Config\Database::connect();

        $summary = [
            'farm' => $farm,
            'zones_count' => $db->table('zones')->where('farm_id', $id)->countAllResults(),
            'tbs_30days' => $db->table('tbs_records')
                ->selectSum('weight_kg')
                ->where('farm_id', $id)
                ->where('record_date >=', date('Y-m-d', strtotime('-30 days')))
                ->get()
                ->getRow()->weight_kg ?? 0,
            'oil_30days' => $db->table('production_records')
                ->selectSum('crude_oil_kg')
                ->where('farm_id', $id)
                ->where('production_date >=', date('Y-m-d', strtotime('-30 days')))
                ->get()
                ->getRow()->crude_oil_kg ?? 0,
        ];

        return $this->respond([
            'success' => true,
            'data' => $summary
        ]);
    }
}
