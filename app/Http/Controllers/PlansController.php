<?php

namespace App\Http\Controllers;

use App\Models\PlansModel;
use Illuminate\Http\Request;
use App\Http\Resources\Plans as PlansResource;
use App\Http\Resources\PlansCollection;
use Validator;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plan = PlansModel::all();
        return new PlansCollection($plan, 200);
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
            'id_company' => 'required|numeric',
            'plan_name' => 'required',
            'planned_start_date' => 'required|date',
            'planned_end_date' => 'required|date',
            'actual_start_date' => 'date',
            'actual_end_date' => 'date',
            'percentage' => 'numeric'
        ];
        // 'name'  => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/']
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        else{
            $data = PlansModel::create($request->all());
            return new PlansResource($data, 201);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlansModel  $plansModel
     * @return \Illuminate\Http\Response
     */
    public function show($pln_id)
    {
        $data = PlansModel::find($pln_id);
        if(is_null($data)){
            return new PlansResource(["message" => "Record not found"], 404);
        }
        else{
            return new PlansResource($data, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlansModel  $plansModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PlansModel $plansModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlansModel  $plansModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pln_id)
    {
        $rules = [
            'id_company' => 'numeric',
            'plan_name' => 'string',
            'planned_start_date' => 'date',
            'planned_end_date' => 'date',
            'actual_start_date' => 'date',
            'actual_end_date' => 'date',
            'percentage' => 'numeric'
        ];
        // 'name'  => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/']
        $data = PlansModel::find($pln_id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($data)){
            return new PlansResource(["message" => "Record not found"], 404);
        }
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }     
        else{
            $data->update($request->all());
            return new PlansResource($data, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlansModel  $plansModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($pln_id)
    {
        $data = PlansModel::find($pln_id);
        if(is_null($data)){
            return new PlansResource(["message" => "Record not found"], 404);
        }
        else{
            $data->delete();
            return new PlansResource(null, 201);
        } 
    }
}
