<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Libraries\ActivityLogger;

class CleanupLogs extends BaseCommand
{
    protected $group = 'Database';
    protected $name = 'db:cleanup';
    protected $description = 'Clean up old activity logs and temporary data';
    protected $usage = 'db:cleanup [--days=90]';
    protected $arguments = [];
    protected $options = [
        'days' => 'Number of days to retain (default: 90)',
    ];

    public function run(array $params = [])
    {
        $days = $params['days'] ?? 90;

        CLI::write('Starting database cleanup...', 'yellow');
        
        $logger = new ActivityLogger();
        $deleted = $logger->clearOldLogs($days);

        CLI::write("Deleted $deleted old activity logs (older than $days days)", 'green');
        CLI::write('Cleanup complete!', 'green');
    }
}
