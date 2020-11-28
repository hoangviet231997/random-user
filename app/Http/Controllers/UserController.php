<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserPrize;
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
            if ($prize_id == 1) return $this->storePrize1($prize_id, $code);
            if ($prize_id == 2) return $this->storePrize2($prize_id, $code);
            if ($prize_id == 3) return $this->storePrize3($prize_id, $code);
        } else {
            return [];
        }
    }

    public function storePrize1($prize_id, $code)
    {
        $user_prize_first = User::where('prize_id', $prize_id)->get();
        if (count($user_prize_first) < 5) {
            $user = User::where('code', $code)->first();
            if ($user) {
                $user->prize_id = $prize_id;
                if ($user->save()) {
                    $user_prize = new UserPrize;
                    $user_prize->user_id = $user->id;
                    $user_prize->prize_id = $prize_id;
                    if ($user_prize->save()) {
                        return DB::table('users')
                            ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                            // ->where('users.prize_id', '=', $prize_id)
                            ->orderBy('users.prize_id')
                            ->select('prizes.prize as prize_name', 'users.*')->get();
                    }
                }
            }
        } else {
            return DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                // ->where('users.prize_id', '=', $prize_id)
                ->orderBy('users.prize_id')
                ->select('prizes.prize as prize_name', 'users.*')->get();
        }
    }

    public function storePrize2($prize_id, $code)
    {
        $user_prize_second = User::where('prize_id', $prize_id)->get();
        if (count($user_prize_second) < 7) {
            $user = User::where('code', $code)->first();
            if ($user) {
                $user->prize_id = $prize_id;
                if ($user->save()) {
                    $user_prize = new UserPrize;
                    $user_prize->user_id = $user->id;
                    $user_prize->prize_id = $prize_id;
                    if ($user_prize->save()) {
                        return DB::table('users')
                            ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                            // ->where('users.prize_id', '=', $prize_id)
                            ->orderBy('users.prize_id')
                            ->select('prizes.prize as prize_name', 'users.*')->get();
                    }
                }
            }
        } else {
            return DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                // ->where('users.prize_id', '=', $prize_id)
                ->orderBy('users.prize_id')
                ->select('prizes.prize as prize_name', 'users.*')->get();
        }
    }

    public function storePrize3($prize_id, $code)
    {
        $user_prize_third = User::where('prize_id', $prize_id)->get();
        if (count($user_prize_third) < 10) {
            $user = User::where('code', $code)->first();
            if ($user) {
                $user->prize_id = $prize_id;
                if ($user->save()) {
                    $user_prize = new UserPrize;
                    $user_prize->user_id = $user->id;
                    $user_prize->prize_id = $prize_id;
                    if ($user_prize->save()) {
                        return DB::table('users')
                            ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                            // ->where('users.prize_id', '=', $prize_id)
                            ->orderBy('users.prize_id')
                            ->select('prizes.prize as prize_name', 'users.*')->get();
                    }
                }
            }
        } else {
            return DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                // ->where('users.prize_id', '=', $prize_id)
                ->orderBy('users.prize_id')
                ->select('prizes.prize as prize_name', 'users.*')->get();
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
        return DB::table('users')->where('prize_id', '<>', null)->orderBy('prize_id')->get();
    }
}
