<?php

namespace App\Console\Commands;

use App\Imports\SchoolsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * php artisan schools:import
     * php artisan schools:import --file=/path/to/custom.xlsx
     */
    protected $signature = 'schools:import
                            {--file= : Path to the Excel file (default: établissements 26-27tel.xlsx in project root)}';

    protected $description = 'Import schools from Excel file into the database (skips duplicates)';

    public function handle(): int
    {
        $defaultFile = base_path('établissements 26-27tel.xlsx');
        $filePath    = $this->option('file') ?? $defaultFile;

        if (! file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return self::FAILURE;
        }

        $this->info("Reading file: {$filePath}");
        $this->newLine();

        $import = new SchoolsImport();

        Excel::import($import, $filePath);

        $this->info("✅ Import complete!");
        $this->table(
            ['Result', 'Count'],
            [
                ['Inserted (new schools)', $import->inserted],
                ['Skipped (already exist)', $import->skipped],
            ]
        );

        return self::SUCCESS;
    }
}

