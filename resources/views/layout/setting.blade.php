@extends('master.index')
@section('content')
<div>
    <div class="title text-center text-danger">
        <div class="alert alert-warning" role="alert" style="width: 50%;margin-left: auto;margin-right: auto;">
            <h1 class="alert-heading text-uppercase text-danger">Please enter the prize start time</h1>
    </div>
    <div class="text-center" style="margin: 50px 0 0 0">
        <form class="form" style="width: 50%;margin-left: auto;margin-right: auto;text-align: left;">
            <div class="form-group">
                <input type="datetime-local" class="btn btn-primary" id="time_prize_1"
                    value="{{ date('Y-m-d\TH:i:s', strtotime($date_prize_1[0]->date_start)) }}" />
                <button type="button" class="btn btn-success" onclick="setTimePrizeFirst()">Save</button>
                <label for="" class="text-dark font-weight-bold"> Time Prize
                    First({{ $date_prize_1[0]->date_start }})</label>
            </div>
            <div class="form-group">
                <input type="datetime-local" class="btn btn-primary" id="time_prize_2"
                    value="{{ date('Y-m-d\TH:i:s', strtotime($date_prize_2[0]->date_start)) }}" />
                <button type="button" class="btn btn-success" onclick="setTimePrizeRunnerUp()">Save</button>
                <label for="" class="text-dark font-weight-bold"> Time Prize Runner
                    Up({{ $date_prize_2[0]->date_start }})</label>
            </div>
            <div class="form-group">
                <input type="datetime-local" class="btn btn-primary" id="time_prize_3"
                    value="{{ date('Y-m-d\TH:i:s', strtotime($date_prize_3[0]->date_start)) }}" />
                <button type="button" class="btn btn-success" onclick="setTimePrizeConsolation()">Save</button>
                <label for="" class="text-dark font-weight-bold"> Time Prize
                    Consolation({{ $date_prize_3[0]->date_start }})</label>

            </div>
        </form>
    </div>
</div>
@endsection
