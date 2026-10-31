<?php

namespace App\Imports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SchoolsImport implements ToModel, WithHeadingRow, WithChunkReading, SkipsEmptyRows
{
    public int $inserted = 0;
    public int $skipped = 0;

    /**
     * Map each Excel row to a School model.
     * Returns null to skip (school already exists).
     */
    public function model(array $row): ?School
    {
        $code = trim((string) ($row['cd_etab'] ?? ''));
        $name = trim((string) ($row['nom_etaba'] ?? ''));
        $commune = trim((string) ($row['la_com:'] ?? ''));

        // Skip rows with missing essential data
        if (empty($code) && empty($name)) {
            $this->skipped++;
            return null;
        }

        // Check if school already exists by code (if code present) or by name
        $exists = School::where('code', $code)
            ->orWhere('name', $name)
            ->exists();

        if ($exists) {
            $this->skipped++;
            return null;
        }

        $this->inserted++;

        return new School([
            'code' => $code ?: null,
            'name' => $name,
            'commune' => $commune,
            'province' => 'العرائش',
        ]);
    }

    /**
     * Process in chunks to handle large files efficiently.
     */
    public function chunkSize(): int
    {
        return 500;
    }
}

