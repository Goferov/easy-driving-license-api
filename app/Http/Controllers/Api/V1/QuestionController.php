<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreQuestionRequest;
use App\Http\Requests\V1\UpdateQuestionRequest;
use App\Imports\QuestionImport;
use App\Http\Resources\V1\QuestionResource;
use App\Http\Resources\V1\QuestionCollection;
use App\Models\Question;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        die();
        $file = (public_path().'\Baza_pytań_na_egzamin_na_prawo_jazdy_22_02_2022r.xlsx');
        Excel::import(new QuestionImport(), $file);
    }


    public function getTestQuestions() {

        $categoryId = 2; // TODO: CATEGORY ID MUST BE SENT BY POST IN THE FUTURE

        $primaryQuestions = Question::whereIn('points', [3, 2, 1])
            ->where('type_id', '=', '1')
            ->orderByRaw('RAND()')
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category.category_id', $categoryId);
            })
            ->get()
            ->groupBy('points')
            ->map(function ($group, $points) {
                $limit = $points == '3' ? 10 : ($points == '2' ? 6 : 4);
                return $group->random($limit);
            })
            ->flatten(1)
            ->shuffle();

        $specialisedQuestions = Question::whereIn('points', [3, 2, 1])
            ->where('type_id', '=', '2')
            ->orderByRaw('RAND()')
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category.category_id', $categoryId);
            })
            ->get()
            ->groupBy('points')
            ->map(function ($group, $points) {
                $limit = $points == '3' ? 6 : ($points == '2' ? 4 : 2);
                return $group->random($limit);
            })
            ->flatten(1)
            ->shuffle();

        $primary = new QuestionCollection($primaryQuestions);
        $specialised = new QuestionCollection($specialisedQuestions);

        return [
            'primary' => $primary,
            'specialised' => $specialised
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }

    public function import_csv_questions()
    {
        die();
        $file = (public_path().'\Baza_pytań_na_egzamin_na_prawo_jazdy_22_02_2022r.xlsx');
        Excel::import(new QuestionImport(), $file);
    }
}
