# 📘 API Reference - Palm Oil Dashboard

## Base URL
```
http://localhost:8080/api
```

All responses are in JSON format.

---

## Standard Response Format

### Success Response (201/200)
```json
{
  "success": true,
  "data": {...},
  "message": "Operation successful"
}
```

### Error Response (400/404/500)
```json
{
  "success": false,
  "message": "Error description",
  "errors": {
    "field_name": ["error message"]
  }
}
```

---

## 1. TBS Records Management

### GET /api/tbs
List all TBS records with pagination and filtering.

**Query Parameters:**
| Parameter | Type | Required | Default | Description |
|-----------|------|----------|---------|-------------|
| farm_id | integer | Yes | - | Farm ID |
| page | integer | No | 1 | Page number |
| per_page | integer | No | 20 | Records per page |
| date_from | date | No | - | Filter from date (YYYY-MM-DD) |
| date_to | date | No | - | Filter to date (YYYY-MM-DD) |
| quality_grade | string | No | - | Quality grade (A/B/C/Reject) |

**Example Request:**
```bash
GET /api/tbs?farm_id=1&date_from=2024-01-01&quality_grade=A
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "farm_id": 1,
      "zone_id": 1,
      "record_date": "2024-01-15",
      "quantity_bunches": 500,
      "weight_kg": "5000.00",
      "quality_grade": "A",
      "ripeness_level": "ripe",
      "damage_percentage": "2.50",
      "loose_fruits_percentage": "1.00",
      "received_by": "John Doe",
      "storage_location": "Storage A",
      "notes": "Good quality batch",
      "status": "received",
      "created_at": "2024-01-15 10:30:00",
      "updated_at": "2024-01-15 10:30:00"
    }
  ],
  "pagination": {
    "page": 1,
    "per_page": 20,
    "total": 45,
    "total_pages": 3
  }
}
```

---

### POST /api/tbs
Create a new TBS record.

**Request Body:**
```json
{
  "farm_id": 1,
  "zone_id": 1,
  "record_date": "2024-01-15",
  "quantity_bunches": 500,
  "weight_kg": 5000,
  "quality_grade": "A",
  "ripeness_level": "ripe",
  "damage_percentage": 2.5,
  "loose_fruits_percentage": 1.0,
  "received_by": "John Doe",
  "storage_location": "Storage A",
  "notes": "Good quality batch"
}
```

**Required Fields:**
- farm_id
- record_date
- quantity_bunches (1-10000)
- weight_kg (0.01-50000)
- quality_grade (A/B/C/Reject)

**Optional Fields:**
- zone_id, ripeness_level, damage_percentage, loose_fruits_percentage, received_by, storage_location, notes

**Response (201 Created):**
```json
{
  "success": true,
  "message": "TBS record created",
  "data": {
    "id": 1,
    ...
  }
}
```

---

### GET /api/tbs/:id
Get single TBS record.

**Example Request:**
```bash
GET /api/tbs/1
```

**Response:**
```json
{
  "success": true,
  "data": {...}
}
```

---

### PUT /api/tbs/:id
Update TBS record.

**Request Body:** (Same as POST, all fields optional)

**Response:**
```json
{
  "success": true,
  "message": "Record updated",
  "data": {...}
}
```

---

### DELETE /api/tbs/:id
Delete TBS record.

**Response:**
```json
{
  "success": true,
  "message": "Record deleted"
}
```

---

### GET /api/tbs/farm/daily-summary
Get daily TBS summary.

**Query Parameters:**
| Parameter | Type | Required |
|-----------|------|----------|
| farm_id | integer | Yes |
| date | date | No (defaults to today) |

**Response:**
```json
{
  "success": true,
  "date": "2024-01-15",
  "tbs": {
    "total_bunches": 1500,
    "total_weight": 15000,
    "total_records": 3,
    "avg_damage_percentage": 2.8,
    "quality_distribution": {
      "A": 1000,
      "B": 400,
      "C": 100,
      "Reject": 0
    }
  }
}
```

---

## 2. Production Records Management

### GET /api/production
List production records.

**Query Parameters:**
| Parameter | Type | Required | Default |
|-----------|------|----------|---------|
| farm_id | integer | Yes | - |
| page | integer | No | 1 |
| per_page | integer | No | 20 |
| date_from | date | No | - |
| date_to | date | No | - |
| status | string | No | - |

**Status values:** processing, completed, quality_check, archived

---

### POST /api/production
Create production record. **Note:** oil_extraction_rate is auto-calculated.

**Request Body:**
```json
{
  "farm_id": 1,
  "tbs_record_id": null,
  "production_date": "2024-01-15",
  "production_time": "08:00",
  "input_tbs_kg": 5000,
  "crude_oil_kg": 1025,
  "kernel_kg": 350,
  "processing_hours": 8,
  "equipment_used": "Main Press",
  "operator_name": "Ahmad",
  "quality_rating": "good",
  "defects_noted": null
}
```

**Auto-calculated:** 
```
oil_extraction_rate = (crude_oil_kg / input_tbs_kg) × 100
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "farm_id": 1,
    "production_date": "2024-01-15",
    "input_tbs_kg": "5000.00",
    "crude_oil_kg": "1025.00",
    "kernel_kg": "350.00",
    "oil_extraction_rate": "20.50",
    "processing_hours": "8.00",
    "equipment_used": "Main Press",
    "operator_name": "Ahmad",
    "quality_rating": "good",
    "status": "completed",
    ...
  }
}
```

---

## 3. Harvesting Records Management

### GET /api/harvesting
List harvesting records.

**Query Parameters:**
| Parameter | Type | Required |
|-----------|------|----------|
| farm_id | integer | Yes |
| page | integer | No |
| per_page | integer | No |
| date_from | date | No |
| date_to | date | No |
| status | string | No |

**Status values:** planned, in_progress, completed, postponed

---

### POST /api/harvesting
Create harvesting record.

**Request Body:**
```json
{
  "farm_id": 1,
  "zone_id": 1,
  "harvest_date": "2024-01-15",
  "harvesting_time_start": "07:00",
  "harvesting_time_end": "15:00",
  "crew_size": 15,
  "bunches_harvested": 800,
  "weight_harvested_kg": 8000,
  "labor_hours": 8,
  "waste_branches_kg": 200,
  "weather_conditions": "clear",
  "equipment_used": "Manual cutters",
  "notes": "Good harvest day"
}
```

**Required Fields:**
- farm_id, zone_id, harvest_date, bunches_harvested, weight_harvested_kg

---

## 4. Farm Settings Management

### GET /api/farm-settings
Get farm settings.

**Query Parameters:**
```
farm_id: integer (required)
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "farm_id": 1,
    "target_tbs_daily_kg": "5000.00",
    "target_extraction_rate": "20.50",
    "target_oil_yield_percentage": "22.00",
    "maintenance_schedule_days": 30,
    "storage_capacity_kg": "100000.00",
    "operating_hours_per_day": 8,
    "quality_threshold_percentage": "80.00",
    "alert_inventory_level": null,
    "currency_code": "USD",
    "language_preference": "en",
    "auto_backup_enabled": 1,
    "created_at": "2024-01-01 10:00:00",
    "updated_at": "2024-01-15 14:30:00"
  }
}
```

---

### POST /api/farm-settings
Create farm settings.

**Request Body:**
```json
{
  "farm_id": 1,
  "target_tbs_daily_kg": 5000,
  "target_extraction_rate": 20.5,
  "target_oil_yield_percentage": 22,
  "storage_capacity_kg": 100000,
  "operating_hours_per_day": 8,
  "quality_threshold_percentage": 80,
  "language_preference": "en",
  "auto_backup_enabled": 1
}
```

---

## 5. Dashboard Analytics

### GET /api/dashboard/kpi
Get key performance indicators.

**Query Parameters:**
```
farm_id: integer (required)
```

**Response:**
```json
{
  "success": true,
  "kpi": {
    "tbs_received_30d": 45000,
    "oil_produced_30d": 9225,
    "avg_extraction_rate": 20.5,
    "quality_percentage": 85.5
  }
}
```

---

### GET /api/dashboard/daily-summary
Get daily summary data.

**Query Parameters:**
```
farm_id: integer (required)
date: date (optional, defaults to today)
```

**Response:**
```json
{
  "success": true,
  "date": "2024-01-15",
  "tbs": {
    "total_bunches": 1500,
    "total_weight": 15000
  },
  "production": {
    "oil_produced": 3075,
    "avg_extraction": 20.5
  }
}
```

---

### GET /api/dashboard/monthly-stats
Get monthly production statistics.

**Query Parameters:**
```
farm_id: integer (required)
month: integer (1-12, required)
year: integer (required)
```

**Response:**
```json
{
  "success": true,
  "period": "January 2024",
  "data": {
    "total_input": 150000,
    "total_oil": 30750,
    "total_kernel": 10500,
    "avg_extraction": 20.5
  }
}
```

---

### GET /api/dashboard/quality-distribution
Get quality grade distribution.

**Query Parameters:**
```
farm_id: integer (required)
days: integer (optional, default 7)
```

**Response:**
```json
{
  "success": true,
  "period_days": 7,
  "data": [
    {"quality_grade": "A", "weight": 8000, "bunches": 700},
    {"quality_grade": "B", "weight": 5000, "bunches": 500},
    {"quality_grade": "C", "weight": 1500, "bunches": 150},
    {"quality_grade": "Reject", "weight": 500, "bunches": 50}
  ]
}
```

---

### GET /api/dashboard/harvesting-stats
Get harvesting performance metrics.

**Query Parameters:**
```
farm_id: integer (required)
days: integer (optional, default 30)
```

**Response:**
```json
{
  "success": true,
  "period_days": 30,
  "stats": {
    "total_bunches": 24000,
    "total_weight": 240000,
    "total_labor_hours": 300,
    "total_harvests": 30,
    "avg_crew_size": 15,
    "avg_productivity_per_hour": 800,
    "avg_bunches_per_day": 800
  }
}
```

---

### GET /api/dashboard/top-days
Get top performing production days.

**Query Parameters:**
```
farm_id: integer (required)
days: integer (optional, default 30)
limit: integer (optional, default 10)
```

**Response:**
```json
{
  "success": true,
  "period_days": 30,
  "top_days": [
    {"date": "2024-01-15", "oil_kg": 1250, "extraction_rate": 21.0},
    {"date": "2024-01-14", "oil_kg": 1180, "extraction_rate": 20.8},
    {"date": "2024-01-13", "oil_kg": 1100, "extraction_rate": 20.2}
  ]
}
```

---

## Field Types & Validation

### Common Field Types

| Type | Range/Format | Validation |
|------|--------------|-----------|
| integer | - | Whole number |
| decimal | 0.01-50000 | 2 decimal places |
| date | YYYY-MM-DD | Valid date |
| time | HH:MM | Valid time |
| enum | Predefined values | Must match list |
| string | Max length | Text input |
| boolean | true/false | 0 or 1 in DB |

### Quality Grades
- **A**: Best quality
- **B**: Good quality
- **C**: Acceptable quality
- **Reject**: Cannot be processed

### Ripeness Levels
- **underripe**: Not ready for processing
- **ripe**: Optimal for processing
- **overripe**: Past optimal ripeness

### Status Values

**TBS Records:**
- received, processed, rejected, archived

**Production:**
- processing, completed, quality_check, archived

**Harvesting:**
- planned, in_progress, completed, postponed

---

## Error Codes & Messages

| Code | Message | Reason |
|------|---------|--------|
| 200 | OK | Successful GET/PUT/DELETE |
| 201 | Created | Successful POST |
| 400 | Bad Request | Validation error |
| 404 | Not Found | Resource not found |
| 422 | Unprocessable Entity | Invalid data |
| 500 | Server Error | Database/server error |

---

## Example JavaScript Requests

### Create TBS Record
```javascript
const tbsData = {
  farm_id: 1,
  record_date: '2024-01-15',
  quantity_bunches: 500,
  weight_kg: 5000,
  quality_grade: 'A',
  ripeness_level: 'ripe',
  damage_percentage: 2.5,
  received_by: 'John Doe'
};

fetch('/api/tbs', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify(tbsData)
})
.then(response => response.json())
.then(data => {
  if (data.success) {
    console.log('Created record ID:', data.data.id);
    alert('TBS record saved successfully!');
  } else {
    console.error('Error:', data.errors);
    alert('Error saving record: ' + JSON.stringify(data.errors));
  }
})
.catch(error => console.error('Network error:', error));
```

### Get All TBS Records with Pagination
```javascript
const farmId = 1;
const page = 1;

fetch(`/api/tbs?farm_id=${farmId}&page=${page}&per_page=20`)
  .then(r => r.json())
  .then(data => {
    console.table(data.data);
    console.log('Total pages:', data.pagination.total_pages);
  });
```

### Get Dashboard KPI
```javascript
fetch('/api/dashboard/kpi?farm_id=1')
  .then(r => r.json())
  .then(data => {
    console.log('KPI Data:', data.kpi);
    console.log('TBS 30d:', data.kpi.tbs_received_30d, 'kg');
    console.log('Oil 30d:', data.kpi.oil_produced_30d, 'kg');
    console.log('Extraction:', data.kpi.avg_extraction_rate, '%');
  });
```

---

## Rate Limiting

Currently **no rate limiting** implemented. Add as needed for production.

Recommended:
- 100 requests per minute per IP
- 1000 requests per hour per API key

---

## Authentication

**Currently**: No authentication required (farm_id parameter only)

**For Production** implement:
- JWT tokens
- API key verification
- Session-based auth

---

## CORS & Headers

**Default Headers:**
```
Content-Type: application/json
Accept: application/json
```

**CORS**: Enabled for local development, configure as needed for production.

---

## Pagination

All list endpoints return:
```json
"pagination": {
  "page": 1,
  "per_page": 20,
  "total": 100,
  "total_pages": 5
}
```

Maximum per_page: 100 (configurable)

---

## Version

**API Version**: 1.0
**Last Updated**: 2024-01-15
**Base URL**: http://localhost:8080/api

---

For complete documentation, see `PALM_OIL_DASHBOARD_README.md`
