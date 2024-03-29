<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'questions' => new QuestionImport(),
//            'products' => new ProductImport(),
//            'orders' => new OrderImport(),
        ];
    }
}
