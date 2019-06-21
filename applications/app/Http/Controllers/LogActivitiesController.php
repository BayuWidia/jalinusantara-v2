<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogActivities;

use Auth;

use DB;
use Validator;
use Alert;
use PDF;
use Datatables;
use Carbon\Carbon;

class LogActivitiesController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
        return view('backend.log.activity');
    }

    public function getDataForDataTable()
    {
        $querys = LogActivities::select(['log_activities.subject','log_activities.url','log_activities.method','log_activities.ip',
                                        'log_activities.agent','log_activities.created_by','log_activities.created_at'])->orderBy('log_activities.created_at', 'DESC');

      return Datatables::of($querys)
        ->editColumn('created_date', function ($query)
        {
            return Carbon::parse($query->created_date)->format('d-m-Y H:i:s');
        })
        ->editColumn('method', function($query){
          if ($query->method=="GET") {
            return "<span class='badge badge-primary'>GET</span>";
          } else {
            return "<span class='badge badge-success'>POST</span>";
          }
        })
        ->removeColumn('id')
        ->make();
    }

}
