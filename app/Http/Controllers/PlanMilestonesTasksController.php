<?php

namespace App\Http\Controllers;

use App\Models\PlanMilestonesTasksModel;
use Illuminate\Http\Request;
use App\Http\Resources\PlanMilestonesTasks as PlanMilestonesTasksResource;
use App\Http\Resources\PlanMilestonesTasksCollection;
use Validator;

class PlanMilestonesTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = PlanMilestonesTasksModel::all();
        return new PlanMilestonesTasksCollection($plan);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'mls_id' => 'required|numeric',
            'task_name' => 'required',
            'percentage' => 'required|numeric',
            'is_completed' => 'required|numeric',
            'planned_startdate' => 'required|date',
            'planned_enddate' => 'required|date',
            'actual_startdate' => 'nullable|date',
            'actual_endate' => 'nullable|date',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanMilestonesTasksResource($validator->errors());
        }
        else{
            $plan = PlanMilestonesTasksModel::create($request->all());
            return new PlanMilestonesTasksResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanMilestonesTasksModel  $planMilestonesTasksModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanMilestonesTasksModel::find($id);
        if(is_null($plan)){
            return new PlanMilestonesTasksResource(['message'=>'Record not found']);
        }
        else{
            return new PlanMilestonesTasksResource($plan);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanMilestonesTasksModel  $planMilestonesTasksModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanMilestonesTasksModel  $planMilestonesTasksModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'mls_id' => 'numeric',
            'task_name' => 'string',
            'percentage' => 'numeric',
            'is_completed' => 'numeric',
            'planned_startdate' => 'date',
            'planned_enddate' => 'date',
            'actual_startdate' => 'date',
            'actual_endate' => 'date',
        ];
        $plan = PlanMilestonesTasksModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanMilestonesTasksResource(['message'=>'Record not found']);
        }
        if($validator->fails()){
            return new PlanMilestonesTasksResource($validator->errors());
        }
        else{
            $plan->update($request->all());
            return new PlanMilestonesTasksResource($plan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanMilestonesTasksModel  $planMilestonesTasksModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanMilestonesTasksModel::find($id);
        if(is_null($plan)){
            return new PlanMilestonesTasksResource(['message'=>'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanMilestonesTasksResource(null);
        }
    }
}
