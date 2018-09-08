<?php
namespace App\Libs;

use DB;

class ExitRule 
{
    public function passes($table, $row, $params, $id)
    {
        $exit = DB::table($parameters[0])->where([ 
        							array($row, $params)
        							array('id', '!=', $id)
        						])->first();
        if (empty($exit) ) {
        	return true;
        }
        return false;
    }
}