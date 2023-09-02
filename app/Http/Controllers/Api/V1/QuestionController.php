<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreQuestionRequest;
use App\Http\Requests\V1\UpdateQuestionRequest;
use App\Imports\QuestionImport;
use App\Models\Question;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $file = (public_path().'\Baza_pytań_na_egzamin_na_prawo_jazdy_22_02_2022r.xlsx');
        Excel::import(new QuestionImport(), $file);

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
//        Excel::import(new UsersImport, $request->file('file')->store('temp'));
//        return back();
    }
}
