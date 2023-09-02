<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->question_id,
            'points' => $this->points,
            'media' => $this->get_file_type($this->file_src),
            'fileSrc' => $this->file_src,
            'question' => $this->question,
            'correctAnswer' => $this->good_answer,
        ];

        if($this->type_id === '2') {
            $data['answer'] = [
                'A' => $this->answer_a,
                'B' => $this->answer_b,
                'C' => $this->answer_c,
            ];
        }

        return $data;
    }


    private function get_file_type($fileSrc) {
        $fileType = '';
        $fileExtension = explode('.', $fileSrc);
        $fileExtension = strtolower(last($fileExtension));

        switch ($fileExtension) {
            case 'jpg':
            case 'png':
                $fileType = 'image';
                break;
            case 'wmv':
            case 'mp4':
                $fileType = 'movie';
                break;
        }

        return $fileType;
    }
}
