# 🚀 Quick Start Guide - Palm Oil Dashboard

## Prerequisites
- Apache/PHP server running (XAMPP recommended)
- CodeIgniter 4 installed
- MySQL database configured
- Browser with JavaScript enabled

---

## Step 1: Run Database Migrations

Open terminal and run:
```bash
cd c:\xampp\htdocs\codeigniterriyan
php spark migrate
```

This creates all 7 tables:
- farms
- zones
- tbs_records
- production_records
- harvesting_records
- farm_settings
- inventory_logs

---

## Step 2: Verify Database Connection

Check your `.env` file:
```
database.default.hostname = localhost
database.default.database = codeigniterriyan
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

---

## Step 3: Create Sample Farm Data (Optional)

Run this SQL in phpMyAdmin to add a test farm:

```sql
INSERT INTO farms (id, name, location, area_hectares, total_zones, established_date, status, created_at, updated_at)
VALUES (1, 'Sample Farm', 'Riau, Indonesia', 500, 5, '2023-01-01', 'active', NOW(), NOW());

INSERT INTO zones (id, farm_id, zone_code, name, area_hectares, crop_age_months, status, created_at, updated_at)
VALUES 
(1, 1, 'ZONE_A', 'Zone A - North Block', 100, 36, 'active', NOW(), NOW()),
(2, 1, 'ZONE_B', 'Zone B - Central Block', 150, 24, 'active', NOW(), NOW()),
(3, 1, 'ZONE_C', 'Zone C - South Block', 120, 18, 'active', NOW(), NOW());

INSERT INTO farm_settings (id, farm_id, target_tbs_daily_kg, target_extraction_rate, storage_capacity_kg, created_at, updated_at)
VALUES (1, 1, 5000, 20.5, 100000, NOW(), NOW());
```

---

## Step 4: Start Development Server

```bash
php spark serve
```

Server runs on: `http://localhost:8080`

---

## Step 5: Access Dashboard

Navigate to:
```
http://localhost:8080/palm-dashboard
```

---

## Testing Each Module

### 📍 **Test 1: Add TBS Record**

1. Click "Add New TBS Record" button
2. Fill form:
   - **Record Date**: Today's date
   - **Quantity**: 500 bunches
   - **Weight**: 5000 kg
   - **Grade**: A
   - **Ripeness**: Ripe
   - **Damage %**: 2.5
   - **Received By**: John Doe
3. Click "Save Record"
4. Record appears in table below

### 📍 **Test 2: Add Production Record**

1. Navigate to "Production Records" tab
2. Click "Add Production Record"
3. Fill form:
   - **Date**: Today
   - **Input TBS**: 5000 kg
   - **Crude Oil**: 1025 kg
   - **Kernel**: 350 kg
   - **Extraction Rate**: Auto-calculated as 20.5%
   - **Equipment**: Main Press
   - **Operator**: Budi
   - **Quality**: Good
4. Save record
5. Verify extraction rate shows ~20.5%

### 📍 **Test 3: Record Harvesting**

1. Go to "Harvesting" tab
2. Click "Add Harvest Record"
3. Fill:
   - **Date**: Today
   - **Zone ID**: 1
   - **Crew Size**: 15
   - **Bunches**: 800
   - **Weight**: 8000 kg
   - **Labor Hours**: 8
   - **Weather**: Clear
4. Save
5. Monthly summary updates automatically

### 📍 **Test 4: View Analytics**

1. Go to "Analytics" tab
2. View KPI cards showing your data
3. Select a month and click "Load Report"
4. Quality chart displays data (if at least 2 TBS records exist)
5. Top 10 days table shows production ranking

### 📍 **Test 5: Update Farm Settings**

1. Go to "Settings" tab
2. Modify settings:
   - Target TBS Daily: 6000 kg
   - Target Extraction: 21%
   - Storage Capacity: 120000 kg
3. Click "Save Settings"
4. Verify "Last Updated" timestamp changes

---

## Testing API Endpoints

### 1️⃣ **Test with Postman or cURL**

#### Get all TBS records:
```bash
curl http://localhost:8080/api/tbs?farm_id=1&page=1&per_page=20
```

#### Create new TBS record:
```bash
curl -X POST http://localhost:8080/api/tbs \
  -H "Content-Type: application/json" \
  -d '{
    "farm_id": 1,
    "record_date": "2024-01-15",
    "quantity_bunches": 400,
    "weight_kg": 4000,
    "quality_grade": "B",
    "ripeness_level": "ripe",
    "damage_percentage": 3.0,
    "received_by": "Ahmad"
  }'
```

#### Get KPI data:
```bash
curl http://localhost:8080/api/dashboard/kpi?farm_id=1
```

#### Get daily summary:
```bash
curl http://localhost:8080/api/dashboard/daily-summary?farm_id=1
```

---

## Browser Console Testing

Open DevTools (F12) → Console and paste:

```javascript
// Test: Get all TBS records
fetch('/api/tbs?farm_id=1&page=1&per_page=10')
  .then(r => r.json())
  .then(d => console.table(d.data));

// Test: Get KPI metrics
fetch('/api/dashboard/kpi?farm_id=1')
  .then(r => r.json())
  .then(d => console.log('KPI:', d.kpi));

// Test: Get analytics
fetch('/api/dashboard/quality-distribution?farm_id=1&days=7')
  .then(r => r.json())
  .then(d => console.table(d.data));
```

---

## Common Issues & Solutions

### ❌ **Error: Table doesn't exist**
- Run migrations: `php spark migrate`
- Check database name matches `.env`

### ❌ **Records not saving**
- Check browser console for errors (F12)
- Verify farm_id=1 in database
- Check MySQL error log

### ❌ **Charts not showing**
- Verify Chart.js loaded (check Network tab)
- Need at least 2 data points for chart
- Check browser console for JS errors

### ❌ **API returns 404**
- Verify routes are correct in `app/Config/Routes.php`
- Check controller namespace: `App\Controllers\Api`
- Ensure controller files exist

### ❌ **CORS issues**
- Check if running on same domain
- Verify API endpoints responding to localhost

---

## Sample Test Data

```sql
-- Add more test TBS records
INSERT INTO tbs_records (farm_id, zone_id, record_date, quantity_bunches, weight_kg, quality_grade, ripeness_level, damage_percentage, received_by, status, created_at, updated_at) VALUES
(1, 1, CURDATE(), 500, 5000, 'A', 'ripe', 2.0, 'John', 'received', NOW(), NOW()),
(1, 1, CURDATE(), 450, 4500, 'A', 'ripe', 2.5, 'Ahmad', 'received', NOW(), NOW()),
(1, 2, CURDATE(), 600, 6000, 'B', 'ripe', 4.0, 'Budi', 'received', NOW(), NOW());

-- Add production records
INSERT INTO production_records (farm_id, production_date, input_tbs_kg, crude_oil_kg, kernel_kg, processing_hours, operator_name, quality_rating, status, created_at, updated_at) VALUES
(1, CURDATE(), 5000, 1025, 350, 8, 'Operator A', 'good', 'completed', NOW(), NOW()),
(1, DATE_SUB(CURDATE(), INTERVAL 1 DAY), 4500, 922, 315, 7.5, 'Operator B', 'excellent', 'completed', NOW(), NOW());
```

---

## Performance Notes

- Pagination: 20 records per page (configurable)
- Auto-refresh: 5 minutes (configurable in JavaScript)
- Charts: Chart.js library (lightweight)
- Database: Indexed on farm_id, dates for fast queries
- API Response: JSON format, typically <200ms

---

## Next: Production Deployment

When ready for production:

1. **Set debug to false** in `.env`
2. **Enable database connection pooling**
3. **Set appropriate file permissions** (755 for folders, 644 for files)
4. **Configure HTTPS/SSL**
5. **Set up database backups**
6. **Enable error logging**
7. **Configure CSRF protection** (already enabled)
8. **Set appropriate session timeout**

---

## 📚 Documentation

- Full API documentation: See `PALM_OIL_DASHBOARD_README.md`
- CodeIgniter docs: https://codeigniter.com/user_guide/
- Chart.js docs: https://www.chartjs.org/

---

## 🎉 Ready to Go!

Your dashboard is fully functional. Start testing and begin entering your palm oil farm data!

For support or questions, refer to the main README file.
