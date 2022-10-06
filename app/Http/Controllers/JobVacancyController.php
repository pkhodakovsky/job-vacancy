<?php

namespace App\Http\Controllers;

use App\Enums\Setting\SettingEnum;
use App\Helpers\Setting\SettingHelper;
use App\Http\Requests\JobVacancyRequest;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('NewJob');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(JobVacancyRequest $request)
    {
        $jobVacancy = array_merge($request->validated(), ['job_no' => 0, 'user_id' => auth()->id()]);
        try {
            JobVacancy::create($jobVacancy);

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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
