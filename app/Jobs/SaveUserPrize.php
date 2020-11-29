<?php

namespace App\Jobs;

use App\User;
use App\UserPrize;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SaveUserPrize implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $prize_id;
    public $code;

    public function __construct($prize_id, $code)
    {
        $this->prize_id = $prize_id;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(10);
        if ($this->prize_id == 1) $this->storePrize1($this->prize_id, $this->code);
        if ($this->prize_id == 2) $this->storePrize2($this->prize_id, $this->code);
        if ($this->prize_id == 3) $this->storePrize3($this->prize_id, $this->code);
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
            DB::table('jobs')->truncate();
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
            DB::table('jobs')->truncate();
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
            DB::table('jobs')->truncate();
            return DB::table('users')
                ->join('prizes', 'users.prize_id', '=', 'prizes.id')
                // ->where('users.prize_id', '=', $prize_id)
                ->orderBy('users.prize_id')
                ->select('prizes.prize as prize_name', 'users.*')->get();
        }
    }
}
