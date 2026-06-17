<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SeedDatabase extends BaseCommand
{
    protected $group = 'Database';
    protected $name = 'db:seed-palm';
    protected $description = 'Seed database with sample palm oil farm data';
    protected $usage = 'db:seed-palm [--fresh]';
    protected $arguments = [];
    protected $options = [
        'fresh' => 'Clear all tables before seeding',
    ];

    public function run(array $params = [])
    {
        $seeder = \Config\Database::seeder();
        $fresh = $params['fresh'] ?? false;

        try {
            if ($fresh) {
                CLI::write('WARNING: Clearing all data!', 'yellow');
                if (CLI::prompt('Continue? (yes/no)', ['yes', 'no']) === 'yes') {
                    // Clear tables in reverse order due to foreign keys
                    CLI::write('Truncating tables...', 'yellow');
                    // Truncate in order (respect FK constraints)
                    $this->truncateTable('activity_logs');
                    $this->truncateTable('inventory_logs');
                    $this->truncateTable('harvesting_records');
                    $this->truncateTable('production_records');
                    $this->truncateTable('tbs_records');
                    $this->truncateTable('farm_settings');
                    $this->truncateTable('zones');
                    $this->truncateTable('farms');
                    CLI::write('Tables cleared', 'green');
                } else {
                    CLI::write('Aborted', 'red');
                    return;
                }
            }

            CLI::write('Seeding database with sample data...', 'yellow');
            $seeder->call('DatabaseSeeder');
            CLI::write('Database seeding complete!', 'green');
            CLI::write('Sample farms created:', 'green');
            CLI::write('  1. Plantation Utama (500 ha)', 'green');
            CLI::write('  2. Farm Timur (300 ha)', 'green');
            CLI::write('30 days of sample data generated', 'green');
        } catch (\Exception $e) {
            CLI::write('Error: ' . $e->getMessage(), 'red');
        }
    }

    private function truncateTable($table)
    {
        $db = \Config\Database::connect();
        $db->table($table)->truncate();
    }
}
