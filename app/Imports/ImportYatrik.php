<?php

namespace App\Imports;

use App\Models\Yatrik;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToArray;

class ImportYatrik implements WithHeadingRow, ToArray
{
    public function array(array $array)
    {
        return $array;
    }
}
