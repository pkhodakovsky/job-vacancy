<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacancyResponseRequest;
use App\Http\Resources\JobVacancyResponseResource;
use App\Models\JobVacancy;
use App\Models\JobVacancyResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobVacancyResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(JobVacancyResponseRequest $request)
    {
        try {
            JobVacancyResponse::create([
                'body'           => $request->body,
                'user_id'        => auth()->id(),
                'job_vacancy_id' => $request->job_vacancy_id,
            ]);
            return response()->json(['message' => trans('Successfully done')]);
        } catch (ValidationException  $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = JobVacancyResponse::where('job_vacancy_id', $id)->with('user')
            ->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
