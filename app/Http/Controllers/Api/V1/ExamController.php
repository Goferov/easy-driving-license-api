<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateExamRequest;
use App\Models\Exam;
use App\Models\Answer;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateExamRequest $request)
    {
        $data = $request->all();

        $exam = Exam::create([
            'user_id' => auth()->user()?->id,
            'category_id' => 2 // TODO: MAKE MORE CATEGORIES IN FUTURE
            //'points' ??? TODO: Push all points to db?
        ]);

        $this->addAnswers($exam, $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }

    private function addAnswers(Exam $exam, $data)
    {
        $answers = array_merge($data['primary'],$data['specialised']);

        foreach ($answers as $answer) {
            Answer::create([
                'exam_id' => $exam->exam_id,
                'question_id' => $answer['id'],
                'answer' => $answer['answer'],
                // 'is_correct' ???
            ]);
        }
    }
}
