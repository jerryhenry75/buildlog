<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;
use Auth;
use Jenssegers\Date\Date;
use Event;


class Buildlog extends Model
{
    
    public static function boot()
    {


        static::creating(function ($model)  {

            
            
        });

        static::created(function ($model) {


            DB::table('buildlog')->insert(array(
                      
                        'table'      => $model->getTable(),
                        'user_id'    => Auth::user()->id,
                        'user_name'  => Auth::user()->nombre,
                        'rows_key'   => (!empty($model->getKey())) ? $model->getKey():0,
                        'event'      => 'created',
                        'original'   => json_encode($model->getOriginal()),
                        'after'      => json_encode($model->getdirty()),
                       // 'query'      => $query,
                        'created_at' =>  Date::now()->format('Y-m-d H:i:s'),
                        'updated_at' =>  Date::now()->format('Y-m-d H:i:s')

                    ));
                    
          });

        static::updated(function ($model) {

            $evento = "updated";
            $estatus = $model->getOriginal('estatus');

            $estatus_nuevo = $model->getattributevalue('estatus');

            if (!is_null($estatus)){
                if ($estatus == 1){
                    if (!is_null($estatus_nuevo)){
                        if ($estatus_nuevo == 0){

                            $evento = "disable";

                        }


                    }


                }

            }

            DB::table('buildlog')->insert(array(
                  
                    'table'      => $model->getTable(),
                    'user_id'    => Auth::user()->id,
                    'user_name'  => Auth::user()->nombre,
                    'rows_key'   => $model->getKey(),
                    'event'      => $evento,
                    'original'   => json_encode($model->getOriginal()),
                    'after'      => json_encode($model->getdirty()),
                    'created_at' =>  Date::now()->format('Y-m-d H:i:s'),
                    'updated_at' =>  Date::now()->format('Y-m-d H:i:s')

                ));
             
        });

        static::deleted(function ($model) {

               DB::table('buildlog')->insert(array(
                      
                        'table'      => $model->getTable(),
                        'user_id'    => Auth::user()->id,
                        'user_name'  => Auth::user()->nombre,
                        'rows_key'   => (!empty($model->getKey())) ? $model->getKey():0,
                        'event'      => 'deleted',
                        'original'   => json_encode($model->getOriginal()),
                        'after'      => json_encode($model->getdirty()),
                       // 'query'      => $query,
                        'created_at' =>  Date::now()->format('Y-m-d H:i:s'),
                        'updated_at' =>  Date::now()->format('Y-m-d H:i:s')

                    ));

                
         });
        
        parent::boot();
    }

    
}

?>