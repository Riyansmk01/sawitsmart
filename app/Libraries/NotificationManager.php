<?php

namespace App\Libraries;

/**
 * Notification System - Email and SMS
 */
class NotificationManager
{
    protected $email;
    protected $db;
    protected $settings;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->email = \Config\Services::email();
    }

    /**
     * Send email notification
     */
    public function sendEmailNotification($to, $subject, $template, $data = [])
    {
        try {
            $view = view($template, $data);

            $this->email->setFrom(getenv('EMAIL_FROM', 'noreply@palmoildash.local'));
            $this->email->setTo($to);
            $this->email->setSubject($subject);
            $this->email->setMessage($view);

            if ($this->email->send()) {
                // Log notification
                $this->logNotification('email', $to, $subject, 'sent');
                return true;
            } else {
                $this->logNotification('email', $to, $subject, 'failed', $this->email->printDebugger());
                return false;
            }
        } catch (\Exception $e) {
            $this->logNotification('email', $to, $subject, 'error', $e->getMessage());
            return false;
        }
    }

    /**
     * Send alert email - TBS Target
     */
    public function sendTbsTargetAlert($farmId, $data)
    {
        $farm = $this->db->table('farms')->where('id', $farmId)->first();
        
        $subject = "TBS Target Alert - {$farm->name}";
        $template = 'emails/alerts/tbs_target';
        
        return $this->sendEmailNotification($farm->contact_email, $subject, $template, [
            'farm' => $farm,
            'data' => $data,
        ]);
    }

    /**
     * Send alert email - Extraction Rate
     */
    public function sendExtractionRateAlert($farmId, $data)
    {
        $farm = $this->db->table('farms')->where('id', $farmId)->first();
        
        $subject = "Extraction Rate Alert - {$farm->name}";
        $template = 'emails/alerts/extraction_rate';
        
        return $this->sendEmailNotification($farm->contact_email, $subject, $template, [
            'farm' => $farm,
            'data' => $data,
        ]);
    }

    /**
     * Send alert email - Quality
     */
    public function sendQualityAlert($farmId, $data)
    {
        $farm = $this->db->table('farms')->where('id', $farmId)->first();
        
        $subject = "Quality Alert - {$farm->name}";
        $template = 'emails/alerts/quality';
        
        return $this->sendEmailNotification($farm->contact_email, $subject, $template, [
            'farm' => $farm,
            'data' => $data,
        ]);
    }

    /**
     * Send daily report email
     */
    public function sendDailyReport($farmId, $recipientEmail = null)
    {
        $farm = $this->db->table('farms')->where('id', $farmId)->first();
        $reportGen = new ReportGenerator();
        $report = $reportGen->generateDailyReport($farmId);
        
        if (!$recipientEmail) {
            $recipientEmail = $farm->contact_email;
        }

        $subject = "Daily Report - {$farm->name} - " . date('Y-m-d');
        $template = 'emails/reports/daily_report';
        
        return $this->sendEmailNotification($recipientEmail, $subject, $template, [
            'farm' => $farm,
            'report' => $report,
        ]);
    }

    /**
     * Send SMS notification (stub for SMS gateway integration)
     */
    public function sendSmsNotification($phone, $message)
    {
        // This is a stub - integrate with actual SMS gateway (Twilio, AWS SNS, etc)
        // Example: Twilio
        /*
        $account_sid = getenv('TWILIO_ACCOUNT_SID');
        $auth_token = getenv('TWILIO_AUTH_TOKEN');
        $from = getenv('TWILIO_PHONE');
        
        $client = new \Twilio\Rest\Client($account_sid, $auth_token);
        
        $message = $client->messages->create(
            $phone,
            [
                "from" => $from,
                "body" => $message,
            ]
        );
        */

        $this->logNotification('sms', $phone, $message, 'sent');
        return true;
    }

    /**
     * Log notification
     */
    protected function logNotification($type, $recipient, $subject, $status, $details = null)
    {
        $this->db->table('notifications')->insert([
            'type' => $type,
            'recipient' => $recipient,
            'subject' => $subject,
            'status' => $status,
            'details' => $details,
            'sent_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Get notification history
     */
    public function getNotificationHistory($limit = 100)
    {
        return $this->db->table('notifications')
            ->orderBy('sent_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Get failed notifications for retry
     */
    public function getFailedNotifications()
    {
        return $this->db->table('notifications')
            ->where('status', 'failed')
            ->where('sent_at <', date('Y-m-d H:i:s', strtotime('-1 hour')))
            ->get()
            ->getResultArray();
    }
}
