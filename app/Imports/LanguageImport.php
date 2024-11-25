<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\TranslationLoader\LanguageLine;


class LanguageImport implements toModel, WithHeadingRow
{
    public function model(array $row)
    {
        if(!array_filter($row)) {
            return null;
        }
        if(!isset($row['group'])) {
            return null;
        }
        $languages = array_slice($row,2,count($row));
        return LanguageLine::create([
            'group' => $row['group'],
            'key' => $row['key'],
            'text' => $languages
        ]);
    }
}
