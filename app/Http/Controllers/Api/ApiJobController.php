<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobVacancyRequest;
use App\Models\JobVacancy;
use App\Services\Models\JobVacancyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ApiJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(
            'edit',
            'create',
            'destroy',
            'store',
            'update'
        );
    }

    public function index()
    {
        return response()->json(JobVacancyService::getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(JobVacancyRequest $request)
    {
        $jobVacancy = array_merge(
            $request->validated(),
            ['job_no' => 0, 'user_id' => auth()->id()]
        );
        return JobVacancyService::create($jobVacancy);
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
        return JobVacancyService::show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(JobVacancyRequest $request, $id)
    {
        return JobVacancyService::update($request->validated(), $id);
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
        try {
            $job = JobVacancy::findOrFail($id);
            if ($job->delete()) {
                return response()->json(
                    ['message' => trans('Successfully done')],
                    200
                );
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => trans(
                        "couldn't find your job :id",
                        ["id" => $id]
                    )
                ],
                404
            );
        }
    }
}
