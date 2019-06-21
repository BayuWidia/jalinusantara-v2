<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session;

class LogActivities extends Model
{

    use Notifiable;

    protected $table = 'log_activities';

    protected $primaryKey = 'id_log_activities';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'subject','url','method','ip','agent','created_by','created_date'
    ];


   public static function getDataLogActivities(){
		   $getDatauom = DB::select('SELECT * from log_activities order by created_date desc');
       return $getDatauom;
	 }

   public static function insLogActivities($params){
      $logId = DB::select('INSERT into log_activities(subject, url, method, ip, agent, created_by, created_at) values (?, ?, ?, ?, ?, ?, ?)',
                              [$params['subject'], $params['url'], $params['method'], $params['ip'], $params['agent'], $params['createdBy'], $params['createdAt']]);
      return $logId;
   }


}
