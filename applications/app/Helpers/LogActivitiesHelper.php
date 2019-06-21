<?php

namespace App\Helpers;
use Request;
use App\Models\LogActivities;

use Auth;

class LogActivitiesHelper
{


    public static function insLogActivities($subject)
    {

      $setTgl = date('Y-m-d H:i:s');

      $params=array('subject' => $subject,
                  'url' => Request::fullUrl(),
                  'method' => Request::method(),
                  'ip' => Request::ip(),
                  'agent' => Request::header('user-agent'),
                  'createdBy' => Auth::user()->id,
                  'createdAt' => $setTgl);
      LogActivities::insLogActivities($params);

    }


    public static function logActivityLists()
    {
    	return LogActivities::getDataLogActivities();
    }


}
