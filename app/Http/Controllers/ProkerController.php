<?php

namespace Scheduler\Http\Controllers;

use Illuminate\Http\Request;

use Scheduler\Http\Requests;
use Scheduler\Http\Controllers\Controller;

use Scheduler\Proker;
use Scheduler\Division;
use stdClass;
use Carbon\Carbon;

class ProkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prokers = Proker::all();
        return response()->json($prokers);
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
        if($request->password != "solideogloria")
            return response()->json([
                'message' => 'Not Authorized',
            ], 401);

        $proker = new Proker;
        $proker->name = $request->name;
        $proker->description = $request->description;
        $proker->start_date = date($request->startDate);
        $proker->end_date = date($request->endDate);
        $proker->division_id = $request->division;
        $proker->save();

        return response()->json($proker);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prokers = Proker::find($id);
        return response()->json($prokers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->password != "solideogloria")
            return response()->json([
                'message' => 'Not Authorized',
            ], 401);

        $proker = Proker::find($id);
        $proker->name = $request->name;
        $proker->description = $request->description;
        $proker->start_date = Carbon::parse($request->startDate)->format('Y-m-d');
        $proker->end_date = Carbon::parse($request->endDate)->format('Y-m-d');
        $proker->done = $request->done;
        $proker->save();

        return response()->json($proker);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->password != "solideogloria")
            return response()->json([
                'message' => 'Not Authorized',
            ], 401);

        $proker = Proker::find($id);
        $proker->delete();
        return response()->json($proker);
    }

    public function timeline() {
        $prokers = Proker::all();
        $timelineItems = [];

        foreach ($prokers as $proker) {
          $item = new stdClass();
          $item->id = $proker->id;
          $item->content = $proker->name;
          $item->start = $proker->start_date;
          $item->end = Carbon::parse($proker->end_date)->addDay()->format('Y-m-d');
          $item->title = $proker->description;


          if (preg_match("/^pleno/i", $proker->name) || preg_match("/^rapat/i", $proker->name)) {
            $item->type = 'background';
            $item->style = "background-color: #FFFF99;";
          } else if (preg_match("/^rkf/i", $proker->name)) {
            $item->type = 'background';
            $item->style = "background-color: #FF9999;";
          } else if (preg_match("/^php panitia/i", $proker->name)) {
            $item->type = 'background';
            $item->style = "background-color: #BBBBFF;";
          } else {
            $item->group = $proker->division_id;
          }

          array_push($timelineItems, $item);
        }

        $divisions = Division::all();
        $timelineGroups = [];

        foreach ($divisions as $division) {
          $item = new stdClass();
          $item->id = $division->id;
          $item->content = $division->shortname;
          array_push($timelineGroups, $item);
        }

        $response = new stdClass();
        $response->items = $timelineItems;
        $response->groups = $timelineGroups;

        return response()->json($response);
    }

}
