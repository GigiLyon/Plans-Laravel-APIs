<?php

namespace App\Http\Controllers;

use App\Models\EbrGroupsModel;
use Illuminate\Http\Request;
use App\Http\Resources\EbrGroups as EbrGroupsResource;
use App\Http\Resources\EbrGroupsCollection;
use Validator;

class EbrGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = EbrGroupsModel::all();
        return new EbrGroupsCollection($plan);
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
            'parent_id' => 'nullable|numeric',
            'group_name' => 'required',
            'id_company' => 'required|numeric',
            'gcd_id' => 'required|numeric',
            'group_admin' => 'required|numeric',
            'group_ccp' => 'required|numeric',
            'group_showcom' => 'required|numeric',
            'is_evaluated' => 'nullable',
            'has_folders' => 'nullable',
            'cm_display' => 'nullable',
            'one_member' => 'nullable',
            'is_meeting_group' => 'required|max:1',
            'chairman' => 'nullable|max:1',                                                                                             
            'rank' => 'nullable|numeric',
            'is_admin' => 'nullable|max:1',
            'self_managed' => 'required|max:1',
            'message' => 'required|max:1',
            'non_sys_users' => 'nullable|max:1',
            'color_code' => 'nullable'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return new EbrGroupsResource($validator->errors());
        }
        else{
            $data = EbrGroupsModel::create($request->all());
            return new EbrGroupsResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EbrGroupsModel  $ebrGroupsModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = EbrGroupsModel::find($id);
        if(is_null($data)){
            return new EbrGroupsResource(['message' => 'Record not found']);
        }
        else{
            return new EbrGroupsResource($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EbrGroupsModel  $ebrGroupsModel
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
     * @param  \App\Models\EbrGroupsModel  $ebrGroupsModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'parent_id' => 'numeric',
            'id_company' => 'numeric',
            'gcd_id' => 'numeric',
            'group_admin' => 'numeric',
            'group_ccp' => 'numeric',
            'group_showcom' => 'numeric',
            'is_meeting_group' => 'max:1',
            'chairman' => 'max:1',                                                                                             
            'rank' => 'numeric',
            'is_admin' => 'max:1',
            'self_managed' => 'max:1',
            'message' => 'max:1',
            'non_sys_users' => 'max:1'
        ];
        $data = EbrGroupsModel::find($id);
        $validator = Validator::make($request->all(), $rules);
        if(is_null($data)){
            return new EbrGroupsResource(['message' => 'Record not found']);
        }
        if($validator->fails()){
            return new EbrGroupsResource($validator->errors());
        }
        else{
            $data->update($request->all());
            return new EbrGroupsResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EbrGroupsModel  $ebrGroupsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = EbrGroupsModel::find($id);
        if(is_null($data)){
            return new EbrGroupsResource(['message' => 'Record not found']);
        }
        else{
            $data->delete();
            return new EbrGroupsResource(null);
        }
    }
}
