<?php

namespace App\Controllers\Api;

use App\Models\TbsRecordModel;
use CodeIgniter\RESTful\ResourceController;

class TbsController extends ResourceController
{
    protected $modelName = TbsRecordModel::class;
    protected $format = 'json';

    /**
     * GET /api/tbs - List all TBS records
     */
    public function index()
    {
        try {
            $page = (int) ($this->request->getVar('page') ?? 1);
            $perPage = (int) ($this->request->getVar('per_page') ?? 20);
            $farmId = (int) ($this->request->getVar('farm_id') ?? 0);
            $qualityGrade = $this->request->getVar('quality_grade');
            $dateFrom = $this->request->getVar('date_from');
            $dateTo = $this->request->getVar('date_to');

            $query = $this->model;
            
            if ($farmId > 0) {
                $query = $query->byFarm($farmId);
            }

            if ($qualityGrade) {
                $query = $query->byQualityGrade($qualityGrade);
            }

            if ($dateFrom && $dateTo) {
                $query = $query->byDateRange($dateFrom, $dateTo);
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
                    'total_pages' => ceil($total / $perPage),
                ],
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error retrieving records: ' . $e->getMessage(), 500);
        }
    }

    /**
     * POST /api/tbs - Create new TBS record
     */
    public function create()
    {
        try {
            $data = $this->request->getJSON(true);

            if (!$this->model->validate($data)) {
                return $this->fail($this->model->errors(), 400);
            }

            $this->model->insert($data);
            $id = $this->model->getInsertID();

            return $this->respondCreated([
                'success' => true,
                'message' => 'TBS record created successfully',
                'data' => ['id' => $id, 'created_at' => date('Y-m-d H:i:s')],
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error creating record: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/tbs/:id - Get single TBS record
     */
    public function show($id = null)
    {
        try {
            $record = $this->model->find($id);

            if (!$record) {
                return $this->failNotFound('Record not found');
            }

            return $this->respond([
                'success' => true,
                'data' => $record,
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error retrieving record: ' . $e->getMessage(), 500);
        }
    }

    /**
     * PUT /api/tbs/:id - Update TBS record
     */
    public function update($id = null)
    {
        try {
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
                'message' => 'TBS record updated successfully',
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error updating record: ' . $e->getMessage(), 500);
        }
    }

    /**
     * DELETE /api/tbs/:id - Delete TBS record
     */
    public function delete($id = null)
    {
        try {
            $record = $this->model->find($id);

            if (!$record) {
                return $this->failNotFound('Record not found');
            }

            $this->model->delete($id);

            return $this->respond([
                'success' => true,
                'message' => 'TBS record deleted successfully',
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error deleting record: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/tbs/farm/:farm_id/daily-summary - Daily TBS summary
     */
    public function dailySummary()
    {
        try {
            $farmId = (int) ($this->request->getVar('farm_id') ?? 0);
            $date = $this->request->getVar('date') ?? date('Y-m-d');

            if ($farmId <= 0) {
                return $this->fail('Farm ID is required', 400);
            }

            $summary = $this->model->getDailySummary($farmId, $date);

            return $this->respond([
                'success' => true,
                'data' => $summary ?? [
                    'total_bunches' => 0,
                    'total_weight' => 0,
                    'avg_damage' => 0,
                ],
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error retrieving summary: ' . $e->getMessage(), 500);
        }
    }
}
