<?php

namespace Iplan\Http\Controllers;

use Illuminate\Http\Request;

use Iplan\Entity\WorkItem;
use Iplan\Http\Requests;
use Iplan\Entity\Project;

class WorkItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id, Request $request)
    {
        //Get the project associated with that work item
        $project = Project::where('id', '=', $project_id)->first();

        //create  query to select workitem with associated project id for a specific user
        $workitem = WorkItem::where();
        dd($workitem);


        // Return View with projects.
        return view('workitems.single-workitem', ['project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        //Get the project associated with that work item
        $project = Project::where('id', '=', $project_id)->first();

        // Load the view with create new work item form while passing the project variable
        return view('workitems.create-new-work-item', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
        //set validations rules
        $this->validate($request, [
            'new_work_item_title'          => 'required',
            'new_work_item_description'    => 'required',
            'new_work_item_estimated_time' => 'required',
            'new_work_item_type'           => 'required',
            'new_work_item_priority'       => 'required'
        ]);

        // Saving data inputted
        $workitem = WorkItem::create([
            'title' => $request->input('new_work_item_title'),
            'description' => $request->input('new_work_item_description'),
            'estimated_time' => $request->input('new_work_item_estimated_time'),
            'type' => $request->input('new_work_item_type'),
            'priority' => $request->input('new_work_item_priority'),

            'user_id' => Auth::user()->id,
            // 'assigned_user_id' =>
        ]);

        // Go to Single work item Created.
        return redirect(route('workitems.show', ['id' => $workitem->id]))->with([
            'success_message' => 'The project was sucessfully created.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $id)
    {
        // Get the Specific work item using it's ID.
        $workitem = WorkItem::where('id', '=', $id)->first();

        // Load the view with project
        return view('workitems.single-workitem', ['work_items' => $workitem]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $id)
    {
        //load Specific work item using it's ID.

        // Load the view with edit work item form
        return view('workitems. edit-single-work-item.blade');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $id)
    {
        //
    }
}
