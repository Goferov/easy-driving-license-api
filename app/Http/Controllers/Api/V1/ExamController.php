<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateExamRequest;
use App\Models\Exam;
use App\Models\Question;
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
            'category_id' => 2, // TODO: MAKE MORE CATEGORIES IN FUTURE
            'all_points' => $this->getExamAllPoints($data)
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
    public function show(int $id)
    {

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
        $answers = $this->mergeAnswers($data);

        foreach ($answers as $answer) {
            Answer::create([
                'exam_id' => $exam->exam_id,
                'question_id' => $answer['id'],
                'answer' => $answer['answer'],
                'is_correct' => !($this->isCorrectAnswer($answer['id'], $answer['answer']) == 0),
            ]);
        }
    }

    private function getExamAllPoints($answers) {
        $answers = $this->mergeAnswers($answers);
        $allPoints = 0;
        foreach ($answers as $answer) {
            $allPoints += $this->isCorrectAnswer($answer['id'], $answer['answer']);
        }
        return $allPoints;
    }

    private function isCorrectAnswer($questionId, $answer) {
        $question = Question::find($questionId);
        if($question) {
            if($answer === $question->good_answer) {
                return $question->points;
            }
        }
        return 0;
    }

    private function mergeAnswers($answers) {
        return array_merge($answers['primary'], $answers['specialised']);
    }
}
