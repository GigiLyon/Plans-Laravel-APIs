<?php

namespace App\Http\Controllers;

use App\Models\PlanGroupsModel;
use Illuminate\Http\Request;
use App\Http\Resources\PlanGroups as PlanGroupsResource;
use App\Http\Resources\PlanGroupsCollection;
use Validator;

class PlanGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = PlanGroupsModel::all();
        return new PlanGroupsCollection($plan);
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
            'pct_id' => 'required|numeric', 
            'pln_id' => 'required|numeric', 
            'id_group' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanGroupsResource($validator->errors());
        }
        else{
            $plan = PlanGroupsModel::create($request->all());
            return new PlanGroupsResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanGroupsModel  $planGroupsModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanGroupsModel::find($id);
        if(is_null($plan)){
            return new PlanGroupsResource(['message'=>'Record not found']);
        }
        else{
            return new PlanGroupsResource($plan);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanGroupsModel  $planGroupsModel
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
     * @param  \App\Models\PlanGroupsModel  $planGroupsModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'pct_id' => 'numeric', 
            'pln_id' => 'numeric', 
            'id_group' => 'numeric',
        ];
        $plan = PlanGroupsModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanGroupsResource(['message'=>'Record not found']);
        }
        if($validator->fails()){
            return new PlanGroupsResource($validator->errors());
        }
        else{
            $plan->update($request->all());
            return new PlanGroupsResource($plan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanGroupsModel  $planGroupsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanGroupsModel::find($id);
        if(is_null($plan)){
            return new PlanGroupsResource(['message'=>'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanGroupsResource(null);
        }
    }
}
