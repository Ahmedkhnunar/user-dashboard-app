<?php
namespace App\Http\Controllers;
ini_set('memory_limit', '2048M');

use Illuminate\Http\Request;

class UserController extends Controller
{
    private $aSortBy = [];
    function __construct()
    {
        $this->aSortBy = ['name', 'impression', 'conversion', 'revenue'];
    }

    public function index(Request $request)
    {
        $sortBy = ($request->sortby) ? $request->sortby : false;
        $users = $this->getUserLogs($sortBy);
        return view('dashboard',compact('users'));
    }

    public function show(){
        return $users = $this->getUserLogs();
    }

    public function getUserLogs($sortBy = false)
    {
        $users = json_decode(file_get_contents(storage_path() . "/users.json"), true);
        $logs = json_decode(file_get_contents(storage_path() . "/logs.json"), true);

        foreach ($users as $key => $user) {
            
            $user_id = $user['id'];

            $userLogs = array_filter($logs, function ($var) use ($user_id) { return ($var['user_id'] == $user_id ); });
            $countValues = array_count_values( array_column($userLogs, 'type'));

            $users[$key]['impression'] = $countValues['impression'];
            $users[$key]['conversion'] = $countValues['conversion'];
            $users[$key]['revenue'] = number_format((float)array_sum(array_column($userLogs, 'revenue')), 2, '.', '');

            array_walk($userLogs, function (&$v){ unset($v['type']); unset($v['user_id']); });
            usort($userLogs, function($a, $b) { return $a['time'] <=> $b['time']; });
             
            $users[$key]['revenuelogs']=array_column($userLogs, 'revenue');
            $users[$key]['timelogs']=array_column($userLogs, 'time');

            $users[$key]['duration'] = date('n/d',strtotime($users[$key]['timelogs'][0])) ." - ". date('n/d',strtotime(end($users[$key]['timelogs'])));
        }

        if ( $sortBy && (in_array($sortBy, $this->aSortBy)) ) {
            usort($users, function($a, $b) use ($sortBy) { return ($sortBy == 'name') ? $a[$sortBy] > $b[$sortBy] : $a[$sortBy] < $b[$sortBy]; });
        }

        return $users;
    }
}
