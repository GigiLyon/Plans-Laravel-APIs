<?php

namespace App\Http\Controllers;

use App\Models\PlanFilesModel;
use App\Http\Resources\PlanFiles as PlanFilesResource;
use App\Http\Resources\PlanFilesCollection;
use Illuminate\Http\Request;
use Validator;

class PlanFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = PlanFilesModel::all();
        return new PlanFilesCollection($plans, 200);
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
            'pln_id'=> 'nullable|numeric',
            'name'=> 'required',
            'size'=> 'required|numeric',
            'type'=> 'required',
            'url' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'title'=> 'required',
            'description'=> 'required',
            'content' => 'nullable'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanFilesResource($validator->errors(), 404);
        }
        else{
            $plan = PlanFilesModel::create($request->all(), 201);
            return new PlanFilesResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanFilesModel  $planFilesModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanFilesModel::find($id);
        if(is_null($plan)){
            return new PlanFilesResource(['message' => 'Record not found!'], 404);
        }
        else{
            return new PlanFilesResource($plan, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanFilesModel  $planFilesModel
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
     * @param  \App\Models\PlanFilesModel  $planFilesModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'pln_id'=> 'numeric',
            'name'=> 'string',
            'size'=> 'numeric',
            'type'=> 'string',
            'title'=> 'string',
            'description'=> 'string',
            'url' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
        $plan = PlanFilesModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanFilesResource(['message' => 'Record not found'], 404);
        }
        if($validator->fails()){
            return new PlanFilesResource($validator->errors(), 404);
        }
        else{
            $plan->update($request->all());
            return new PlanFilesResource($plan, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanFilesModel  $planFilesModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanFilesModel::find($id);
        if(is_null($plan)){
            return new PlanFilesResource(['message' => 'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanFilesResource(null, 201);
        }
    }
}
