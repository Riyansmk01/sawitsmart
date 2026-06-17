<?php

namespace App\Controllers\Api;

use App\Models\ProductionRecordModel;
use CodeIgniter\RESTful\ResourceController;

class ProductionController extends ResourceController
{
    protected $modelName = ProductionRecordModel::class;
    protected $format = 'json';

    public function index()
    {
        try {
            $page = (int) ($this->request->getVar('page') ?? 1);
            $perPage = (int) ($this->request->getVar('per_page') ?? 20);
            $farmId = (int) ($this->request->getVar('farm_id') ?? 0);
            $status = $this->request->getVar('status');
            $dateFrom = $this->request->getVar('date_from');
            $dateTo = $this->request->getVar('date_to');

            $query = $this->model;

            if ($farmId > 0) {
                $query = $query->where('farm_id', $farmId);
            }

            if ($status) {
                $query = $query->where('status', $status);
            }

            if ($dateFrom && $dateTo) {
                $query = $query->where('production_date >=', $dateFrom)
                              ->where('production_date <=', $dateTo);
            }

            $total = $query->countAllResults(false);
            $records = $query->paginate($perPage, 'default', $page);

            return $this->respond([
                'success' => true,
                'data' => $records,
                'pagination' => [
                    'total' => $total,
                    'page' => $page,
                    'per_page' => $perPage,
                ],
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error retrieving records: ' . $e->getMessage(), 500);
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true);

            // Calculate extraction rate
            if (isset($data['input_tbs_kg']) && $data['input_tbs_kg'] > 0) {
                $data['oil_extraction_rate'] = ($data['crude_oil_kg'] / $data['input_tbs_kg']) * 100;
            }

            if (!$this->model->validate($data)) {
                return $this->fail($this->model->errors(), 400);
            }

            $this->model->insert($data);

            return $this->respondCreated([
                'success' => true,
                'message' => 'Production record created',
                'data' => ['id' => $this->model->getInsertID()],
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error creating record: ' . $e->getMessage(), 500);
        }
    }

    public function show($id = null)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return $this->failNotFound('Record not found');
        }
        return $this->respond(['success' => true, 'data' => $record]);
    }

    public function update($id = null)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return $this->failNotFound('Record not found');
        }

        $data = $this->request->getJSON(true);

        if (isset($data['input_tbs_kg']) && $data['input_tbs_kg'] > 0 && isset($data['crude_oil_kg'])) {
            $data['oil_extraction_rate'] = ($data['crude_oil_kg'] / $data['input_tbs_kg']) * 100;
        }

        if (!$this->model->validate($data)) {
            return $this->fail($this->model->errors(), 400);
        }

        $this->model->update($id, $data);
        return $this->respond(['success' => true, 'message' => 'Production record updated']);
    }

    public function delete($id = null)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return $this->failNotFound('Record not found');
        }
        $this->model->delete($id);
        return $this->respond(['success' => true, 'message' => 'Production record deleted']);
    }
}
