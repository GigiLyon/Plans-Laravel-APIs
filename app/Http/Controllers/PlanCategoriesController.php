<?php

namespace App\Http\Controllers;

use App\Models\PlanCategoriesModel;
use Illuminate\Http\Request;
use App\Http\Resources\PlanCategories as PlanCategoriesResource;
use App\Http\Resources\PlanCategoriesCollection;
use Validator;

class PlanCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = PlanCategoriesModel::all();
        return new PlanCategoriesCollection($plan);
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
            'category_name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new PlanCategoriesResource($validator->errors());
        }
        else{
            $plan = PlanCategoriesModel::create($request->all());
            return new PlanCategoriesResource($plan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanCategoriesModel  $planCategoriesModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = PlanCategoriesModel::find($id);
        if(is_null($plan)){
            return new PlanCategoriesResource(['message'=>'Record not found']);
        }
        else{
            return new PlanCategoriesResource($plan);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanCategoriesModel  $planCategoriesModel
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
     * @param  \App\Models\PlanCategoriesModel  $planCategoriesModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'category_name' => 'string'
        ];
        $plan = PlanCategoriesModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($plan)){
            return new PlanCategoriesResource(['message'=>'Record not found']);
        }
        if($validator->fails()){
            return new PlanCategoriesResource($validator->errors());
        }
        else{
            $plan->update($request->all());
            return new PlanCategoriesResource($plan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanCategoriesModel  $planCategoriesModel
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id)
    {
        $plan = PlanCategoriesModel::find($id);
        if(is_null($plan)){
            return new PlanCategoriesResource(['message'=>'Record not found']);
        }
        else{
            $plan->delete();
            return new PlanCategoriesResource(null);
        }
    }
}
