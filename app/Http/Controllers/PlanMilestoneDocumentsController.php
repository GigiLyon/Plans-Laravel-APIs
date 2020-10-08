<?php

namespace App\Http\Controllers;

use App\Models\PlanMilestoneDocumentsModel;
use Illuminate\Http\Request;
use App\Http\Resources\PlanMilestoneDocuments as PlanMilestoneDocumentsResource;
use App\Http\Resources\PlanMilestoneDocumentsCollection;
use Validator;

class PlanMilestoneDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = PlanMilestoneDocumentsModel::all();
        return new PlanMilestoneDocumentsCollection($plan);
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
            'date_uploaded' => 'required|date', 
            'name' => 'required', 
            'size' => 'required|numeric', 
            'type' => 'required', 
            'content' => 'nullable' 
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanMilestoneDocumentsResource($validator->errors());
        }
        else{
            $plan = PlanMilestoneDocumentsModel::create($request->all());
            return new PlanMilestoneDocumentsResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanMilestoneDocumentsModel  $planMilestoneDocumentsModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanMilestoneDocumentsModel::find($id);
        if(is_null($plan)){
            return new PlanMilestoneDocumentsResource(['message'=>'Record not found']);
        }
        else{
            return new PlanMilestoneDocumentsResource($plan);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanMilestoneDocumentsModel  $planMilestoneDocumentsModel
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
     * @param  \App\Models\PlanMilestoneDocumentsModel  $planMilestoneDocumentsModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'mls_id' => 'numeric', 
            'date_uploaded' => 'date', 
            'name' => 'string', 
            'size' => 'numeric', 
            'type' => 'string'
        ];
        $plan = PlanMilestoneDocumentsModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanMilestoneDocumentsResource(['message'=>'Record not found']);
        }
        if($validator->fails()){
            return new PlanMilestoneDocumentsResource($validator->errors());
        }
        else{
            $plan->update($request->all());
            return new PlanMilestoneDocumentsResource($plan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanMilestoneDocumentsModel  $planMilestoneDocumentsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanMilestoneDocumentsModel::find($id);
        if(is_null($plan)){
            return new PlanMilestoneDocumentsResource(['message'=>'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanMilestoneDocumentsResource(null);
        }
    }
}
