<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class IndexController extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $encode = $this->request->id;
        $check_code = DB::table('users')->where('encode', $encode)->count();

        // if ($check_code > 0) {

            // guests (100 request)

            // $guest = User::where('encode', $encode)->where('account', 'guests')->first();
            // if ($guest) {
            //     $guest->online += 1;
            //     if ($guest->save()) {
            //         if ($guest->online > 99) {
            //             return;
            //         }
            //     }
            // }

            $prize = DB::table('prizes')->get();
            $user = DB::table('users')->where('code', '<>', null)->get();
            $userPrize = DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                ->where('prize_id', '<>', null)
                ->orderBy('users.prize_id')
                ->select('prizes.prize as prize_name', 'users.*')->get();
            return view(
                'layout.random',
                [
                    'prize' => $prize,
                    'user' => $user,
                    'userPrize' => $userPrize,
                    'date_prize_1' => DB::table('prizes')->where('id', 1)->select('date_start', 'id')->get(),
                    'date_prize_2' => DB::table('prizes')->where('id', 2)->select('date_start', 'id')->get(),
                    'date_prize_3' => DB::table('prizes')->where('id', 3)->select('date_start', 'id')->get(),
                ]
            );
        // }
    }

    public function setting()
    {
        return view('layout.setting', [
            'date_prize_1' => DB::table('prizes')->where('id', 1)->select('date_start', 'id')->get(),
            'date_prize_2' => DB::table('prizes')->where('id', 2)->select('date_start', 'id')->get(),
            'date_prize_3' => DB::table('prizes')->where('id', 3)->select('date_start', 'id')->get(),
        ]);
    }
}
