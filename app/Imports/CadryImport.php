<?php

namespace App\Imports;

use App\Models\Cadry;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CadryImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        
    }
}