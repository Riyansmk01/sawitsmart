<?php

/**
 * Palm Oil Dashboard - Helper Functions
 */

/**
 * Format number as currency
 */
if (!function_exists('formatCurrency')) {
    function formatCurrency($value, $currency = 'USD', $decimals = 2)
    {
        $currencySymbols = [
            'USD' => '$',
            'IDR' => 'Rp',
            'EUR' => '€',
        ];

        $symbol = $currencySymbols[$currency] ?? '$';
        return $symbol . number_format($value, $decimals, '.', ',');
    }
}

/**
 * Format number with thousand separator
 */
if (!function_exists('formatNumber')) {
    function formatNumber($value, $decimals = 2)
    {
        return number_format($value, $decimals, '.', ',');
    }
}

/**
 * Format percentage
 */
if (!function_exists('formatPercent')) {
    function formatPercent($value, $decimals = 2)
    {
        return number_format($value, $decimals, '.', '') . '%';
    }
}

/**
 * Format weight in kg
 */
if (!function_exists('formatWeight')) {
    function formatWeight($value, $unit = 'kg')
    {
        return formatNumber($value) . ' ' . $unit;
    }
}

/**
 * Get quality grade color/badge
 */
if (!function_exists('getQualityBadge')) {
    function getQualityBadge($grade)
    {
        $colors = [
            'A' => 'success',
            'B' => 'info',
            'C' => 'warning',
            'Reject' => 'danger',
        ];

        $color = $colors[$grade] ?? 'secondary';
        return '<span class="badge bg-' . $color . '">' . htmlspecialchars($grade) . '</span>';
    }
}

/**
 * Get status badge
 */
if (!function_exists('getStatusBadge')) {
    function getStatusBadge($status)
    {
        $colors = [
            'active' => 'success',
            'inactive' => 'secondary',
            'received' => 'info',
            'processed' => 'success',
            'rejected' => 'danger',
            'completed' => 'success',
            'in_progress' => 'warning',
            'pending' => 'warning',
            'failed' => 'danger',
        ];

        $color = $colors[$status] ?? 'secondary';
        $label = ucfirst(str_replace('_', ' ', $status));
        return '<span class="badge bg-' . $color . '">' . $label . '</span>';
    }
}

/**
 * Get alert color based on percentage
 */
if (!function_exists('getAlertColor')) {
    function getAlertColor($percentage, $threshold = 80)
    {
        if ($percentage >= $threshold) {
            return 'success';
        } elseif ($percentage >= ($threshold - 20)) {
            return 'warning';
        } else {
            return 'danger';
        }
    }
}

/**
 * Calculate extraction rate
 */
if (!function_exists('calculateExtractionRate')) {
    function calculateExtractionRate($crudOilKg, $inputTbsKg)
    {
        if ($inputTbsKg <= 0) {
            return 0;
        }
        return ($crudOilKg / $inputTbsKg) * 100;
    }
}

/**
 * Calculate productivity (kg per hour)
 */
if (!function_exists('calculateProductivity')) {
    function calculateProductivity($weightKg, $laborHours)
    {
        if ($laborHours <= 0) {
            return 0;
        }
        return $weightKg / $laborHours;
    }
}

/**
 * Format date in Indonesian
 */
if (!function_exists('formatDateIndo')) {
    function formatDateIndo($date)
    {
        $bulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        if (is_string($date)) {
            $date = new \DateTime($date);
        }

        $bulanIndo = $bulan[$date->format('F')];
        return $date->format('d') . ' ' . $bulanIndo . ' ' . $date->format('Y');
    }
}

/**
 * Get days back date
 */
if (!function_exists('getDaysBackDate')) {
    function getDaysBackDate($days = 30)
    {
        return date('Y-m-d', strtotime("-$days days"));
    }
}

/**
 * Convert hours to time format
 */
if (!function_exists('formatHours')) {
    function formatHours($hours)
    {
        $h = floor($hours);
        $m = round(($hours - $h) * 60);
        return sprintf('%d:%02d', $h, $m);
    }
}

/**
 * Validate email
 */
if (!function_exists('isValidEmail')) {
    function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

/**
 * Validate phone number
 */
if (!function_exists('isValidPhone')) {
    function isValidPhone($phone)
    {
        return preg_match('/^(\+62|0)[0-9]{9,12}$/', str_replace('-', '', $phone));
    }
}

/**
 * Get alert message based on metric
 */
if (!function_exists('getAlertMessage')) {
    function getAlertMessage($metric, $value, $target)
    {
        $percentage = ($value / $target) * 100;

        switch ($metric) {
            case 'tbs':
                if ($percentage < 50) {
                    return 'Critical: TBS target significantly below target';
                } elseif ($percentage < 80) {
                    return 'Warning: TBS target below 80% achievement';
                } else {
                    return 'On track: TBS target being met';
                }

            case 'extraction':
                if ($value > $target + 1) {
                    return 'Excellent: Extraction rate exceeds target';
                } elseif ($value >= $target - 1) {
                    return 'Good: Extraction rate within target range';
                } else {
                    return 'Warning: Extraction rate below target';
                }

            case 'quality':
                if ($percentage >= 90) {
                    return 'Excellent: High quality achievement';
                } elseif ($percentage >= $target) {
                    return 'Good: Quality target met';
                } else {
                    return 'Warning: Quality below threshold';
                }

            default:
                return 'No message';
        }
    }
}

/**
 * Get trend indicator
 */
if (!function_exists('getTrendIndicator')) {
    function getTrendIndicator($current, $previous)
    {
        if ($current > $previous) {
            return '<span style="color: green;"><i class="fas fa-arrow-up"></i> +' . number_format($current - $previous, 2) . '</span>';
        } elseif ($current < $previous) {
            return '<span style="color: red;"><i class="fas fa-arrow-down"></i> ' . number_format($current - $previous, 2) . '</span>';
        } else {
            return '<span style="color: gray;"><i class="fas fa-minus"></i> No change</span>';
        }
    }
}
