<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

//        dump($row);
        //TODO: MAKE UPLOAD TO CATEGORIES :)
        die('Zablokowane');
//        set_time_limit(0);
        if($row['numer_pytania']) {
            return new Question([
                'type_id' => ($row['zakres_struktury'] == 'PODSTAWOWY' ? '1' : ($row['zakres_struktury'] == 'SPECJALISTYCZNY' ? '2' : '')),
                'number' => $row['numer_pytania'],
                'name' => $row['nazwa_pytania'],
                'block_name' => $row['nazwa_bloku'],
                'question' => $row['pytanie'],
                'answer_a' => $row['odpowiedz_a'],
                'answer_b' => $row['odpowiedz_b'],
                'answer_c' => $row['odpowiedz_c'],
                'good_answer' => $row['poprawna_odp'],
                'file_src' => $row['media'],
                'points' => $row['liczba_punktow'],
                'source' => $row['zrodlo_pytania'],
                'goal' => $row['o_co_chcemy_zapytac'],
                'security_relationship' => (string)$row['jaki_ma_zwiazek_z_bezpieczenstwem'],
                'subject' => $row['podmiot'],
            ]);
        }
        else {
            return null;
        }

    }
}
