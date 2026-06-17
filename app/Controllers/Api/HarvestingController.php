<?php

namespace App\Controllers\Api;

use App\Models\HarvestingRecordModel;
use CodeIgniter\API\ResponseTrait;

class HarvestingController extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new HarvestingRecordModel();
    }

    // GET /api/harvesting - List with pagination and filtering
    public function index()
    {
        $farmId = $this->request->getVar('farm_id');
        $page = (int) ($this->request->getVar('page') ?? 1);
        $perPage = (int) ($this->request->getVar('per_page') ?? 20);
        $dateFrom = $this->request->getVar('date_from');
        $dateTo = $this->request->getVar('date_to');
        $status = $this->request->getVar('status');

        $query = $this->model->where('farm_id', $farmId);

        if ($dateFrom) {
            $query = $query->where('harvest_date >=', $dateFrom);
        }
        if ($dateTo) {
            $query = $query->where('harvest_date <=', $dateTo);
        }
        if ($status) {
            $query = $query->where('status', $status);
        }

        $total = $query->countAllResults(false);
        $records = $query->orderBy('harvest_date', 'DESC')
            ->paginate($perPage, 'default', $page);

        return $this->respond([
            'success' => true,
            'data' => $records,
            'pagination' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'total_pages' => ceil($total / $perPage)
            ]
        ]);
    }

    // POST /api/harvesting - Create new record
    public function create()
    {
        $data = $this->request->getJSON(true);
        $data['status'] = $data['status'] ?? 'completed';

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $id = $this->model->insert($data);

        return $this->respondCreated([
            'success' => true,
            'message' => 'Harvesting record created',
            'data' => $this->model->find($id)
        ]);
    }

    // GET /api/harvesting/:id - Show single record
    public function show($id)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return $this->failNotFound('Record not found');
        }

        return $this->respond([
            'success' => true,
            'data' => $record
        ]);
    }

    // PUT /api/harvesting/:id - Update record
    public function update($id)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return $this->failNotFound('Record not found');
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $this->model->update($id, $data);

        return $this->respond([
            'success' => true,
            'message' => 'Record updated',
            'data' => $this->model->find($id)
        ]);
    }

    // DELETE /api/harvesting/:id - Delete record
    public function delete($id)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return $this->failNotFound('Record not found');
        }

        $this->model->delete($id);

        return $this->respond([
            'success' => true,
            'message' => 'Record deleted'
        ]);
    }
}
