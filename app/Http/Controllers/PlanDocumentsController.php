<?php

namespace App\Http\Controllers;

use App\Models\PlanDocumentsModel;
use Illuminate\Http\Request;
use App\Http\Resources\PlanDocuments as PlanDocumentsResource;
use App\Http\Resources\PlanDocumentsCollection;
use Validator;

class PlanDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = PlanDocumentsModel::all();
        return new PlanDocumentsCollection($plan);
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
            'date_uploaded' => 'nullable|date',
            'document_name' => 'required',
            'document_size' => 'required|numeric',
            'document_type' => 'required',
            'content' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanDocumentsResource($validator->errors());
        }
        else{
            $plan = PlanDocumentsModel::create($request->all());
            return new PlanDocumentsResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanDocumentsModel  $planDocumentsModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanDocumentsModel::find($id);
        if(is_null($plan)){
            return new PlanDocumentsResource(['message'=>'Record not found']);
        }
        else{
            return new PlanDocumentsResource($plan);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanDocumentsModel  $planDocumentsModel
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
     * @param  \App\Models\PlanDocumentsModel  $planDocumentsModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'pln_id' => 'numeric',
            'date_uploaded' => 'date',
            'document_size' => 'numeric'
        ];
        $plan = PlanDocumentsModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanDocumentsResource(['message'=>'Record not found']);
        }
        if($validator->fails()){
            return new PlanDocumentsResource($validator->errors());
        }        
        else{
            $plan->update($request->all());
            return new PlanDocumentsResource($plan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanDocumentsModel  $planDocumentsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanDocumentsModel::find($id);
        if(is_null($plan)){
            return new PlanDocumentsResource(['message'=>'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanDocumentsResource(null);
        }
    }
}
