<?php

namespace App\Http\Controllers;

use App\Models\PlanMilestonesModel;
use Illuminate\Http\Request;
use App\Http\Resources\PlanMilestones as PlanMilestonesResource;
use App\Http\Resources\PlanMilestonesCollection;
use Validator;

class PlanMilestonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = PlanMilestonesModel::all();
        return new PlanMilestonesCollection($plan);
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
            'pln_id' => 'required|numeric', 
            'milestone' => 'required', 
            'planned_date' => 'required|date',
            'actual_date' => 'nullable|date',
            'percentage' => 'required|numeric',
            'percentage_progress' => 'nullable|numeric',
            'm_code' => 'nullable',
            'DT_RowId' => 'nullable|date'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanMilestonesResource($validator->errors());
        }
        else{
            $plan = PlanMilestonesModel::create($request->all());
            return new PlanMilestonesResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanMilestonesModel  $planMilestonesModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanMilestonesModel::find($id);
        if(is_null($plan)){
            return new PlanMilestonesResource(['message'=>'Record not found']);
        }
        else{
            return new PlanMilestonesResource($plan);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanMilestonesModel  $planMilestonesModel
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
     * @param  \App\Models\PlanMilestonesModel  $planMilestonesModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'pln_id' => 'numeric', 
            'planned_date' => 'date',
            'actual_date' => 'date',
            'percentage' => 'numeric',
            'percentage_progress' => 'numeric',
            'DT_RowId' => 'date'
        ];
        $plan = PlanMilestonesModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanMilestonesResource(['message'=>'Record not found']);
        }
        if($validator->fails()){
            return new PlanMilestonesResource($validator->errors());
        }
        else{
            $plan->update($request->all());
            return new PlanMilestonesResource($plan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanMilestonesModel  $planMilestonesModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanMilestonesModel::find($id);
        if(is_null($plan)){
            return new PlanMilestonesResource(['message'=>'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanMilestonesResource(null);
        }
    }
}
