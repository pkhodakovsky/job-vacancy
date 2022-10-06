<?php

namespace App\Http\Controllers;

use App\Services\JobVacancyLikeService;
use App\Services\UserLikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        if (UserLikeService::check($request->user_id)) {
            if (UserLikeService::create($request->user_id)) {
                return response()->json(
                    ['message' => trans("Successfully done")]
                );
            }
        }
        return response()->json(
            ['message' => trans("You've Liked This User Already")],
            406
        );
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
        //
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
        if (JobVacancyLikeService::check($id)) {
            if (JobVacancyLikeService::create($id)) {
                return response()->json(
                    ['message' => trans("Successfully done")]
                );
            }
        }
        return response()->json(
            ['message' => trans("You've Liked This job Vacancy Already")],
            406
        );
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
