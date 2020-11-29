<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserPrize;
use App\Jobs\SaveUserPrize;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // if ($user) {
        //     $user->prize_id = $prize_id;
        //     if ($user->save()) {
        //         $prize_name = DB::table('prizes')->where('id', $prize_id)->select('prize')->first();
        //         $user->prize_name = $prize_name->prize;
        //         return $user;
        //     }
        // }
        $code = $request->code ?? '';
        $prize_id = $request->prize_id ?? '';
        if ($code) {
            SaveUserPrize::dispatch($prize_id, $code);
            return DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                ->orderBy('users.prize_id')
                ->select('prizes.prize as prize_name', 'users.*')->get();
        } else {
            return ['does not exists code'];
        }
    }

    public function getUserPrize()
    {
        return [
            'first' => DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                ->where('users.prize_id', 1)
                ->select('prizes.prize as prize_name', 'users.*')
                ->get(),
            'runner_up' => DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                ->where('users.prize_id', 2)
                ->select('prizes.prize as prize_name', 'users.*')
                ->get(),
            'consolation' => DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                ->where('users.prize_id', 3)
                ->select('prizes.prize as prize_name', 'users.*')
                ->get(),
        ];
    }

    public function storeDatePrize(Request $request)
    {
        $prize_id = $request->prize ?? '';
        $date = $request->date ?? '';

        if ($prize_id) {
            $prize = DB::table('prizes')->where('id', $prize_id)->update(['date_start' => $date]);
            if ($prize) {
                $user = DB::update('update users set prize_id = null');
                if ($user) {
                    return $prize;
                }
            }
        }
    }

    public function getAllUser()
    {
        return DB::table('users')->where('prize_id', null)->get();
    }

    public function getAllUserPrize()
    {
        return DB::table('users')
            ->join('prizes', 'users.prize_id', '=', 'prizes.id')
            ->where('prize_id', '<>', null)
            ->select('prizes.prize as prize_name', 'users.*')
            ->orderBy('prize_id')->get();
    }
}
