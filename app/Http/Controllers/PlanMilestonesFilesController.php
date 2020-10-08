<?php

namespace App\Http\Controllers;

use App\Models\PlanMilestonesFilesModel;
use Illuminate\Http\Request;
use App\Http\Resources\PlanMilestonesFiles as PlanMilestonesFilesResource;
use App\Http\Resources\PlanMilestonesFilesCollection;
use Validator;

class PlanMilestonesFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = PlanMilestonesFilesModel::all();
        return new PlanMilestonesFilesCollection($plan);
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
            'name' => 'required',
            'size' => 'required|numeric',
            'type' => 'required',
            'url' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'title' => 'required',
            'description' => 'nullable',
            'content' => 'nullable'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanMilestonesFilesResource($validator->errors());
        }
        else{
            $plan = PlanMilestonesFilesModel::create($request->all());
            return new PlanMilestonesFilesResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanMilestonesFilesModel  $planMilestonesFilesModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanMilestonesFilesModel::find($id);
        if(is_null($plan)){
            return new PlanMilestonesFilesResource(['message'=>'Record not found']);
        }
        else{
            return new PlanMilestonesFilesResource($plan);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanMilestonesFilesModel  $planMilestonesFilesModel
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
     * @param  \App\Models\PlanMilestonesFilesModel  $planMilestonesFilesModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'mls_id' => 'numeric',
            'name' => 'string',
            'size' => 'numeric',
            'type' => 'string',
            'url' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
        $plan = PlanMilestonesFilesModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanMilestonesFilesResource(['message'=>'Record not found']);
        }
        if($validator->fails()){
            return new PlanMilestonesFilesResource($validator->errors());
        }
        else{
            $plan->update($request->all());
            return new PlanMilestonesFilesResource($plan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanMilestonesFilesModel  $planMilestonesFilesModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanMilestonesFilesModel::find($id);
        if(is_null($plan)){
            return new PlanMilestonesFilesResource(['message'=>'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanMilestonesFilesResource(null);
        }
    }
}
