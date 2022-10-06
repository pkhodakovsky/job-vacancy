<?php

namespace App\Http\Controllers;

use App\Enums\Setting\SettingEnum;
use App\Helpers\Setting\SettingHelper;
use App\Http\Requests\JobVacancyRequest;
use App\Http\Resources\JobVacancyResource;
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
        $jobs = JobVacancy::all();

        return response()->json($jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware(['auth', 'verified']);

        return Inertia::render('NewJob');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(JobVacancyRequest $request)
    {
        $this->middleware(['auth', 'verified']);
        $jobVacancy = array_merge(
            $request->validated(),
            ['job_no' => 0, 'user_id' => auth()->id()]
        );
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
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new JobVacancyResource(JobVacancy::with(['user'])->find($id));
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
        $this->middleware(['auth', 'verified']);
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
        $this->middleware(['auth', 'verified']);
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
        $this->middleware(['auth', 'verified']);
    }
}
