@extends('master.index')
@section('content')
    <div class="title text-center text-danger">
        <div class="alert alert-warning" role="alert">
            <h1 class="alert-heading text-uppercase text-danger">Winning lottery program</h1>
            <a href="#">
                <h2 class="text-bold" data-toggle="modal" data-target="#giainhat" style="font-weight: 800">
                    <span id="name_prize"></span>
                </h2>
            </a>
        </div>
        {{-- @if (date('Y-m-d H:i') === $date_prize_1[0]->date_start || date('Y-m-d H:i') === $date_prize_2[0]->date_start || date('Y-m-d H:i') === $date_prize_3[0]->date_start) --}}
            <div id="random">000000</div>
        {{-- @else --}}
            {{-- <div id="non-random">00000</div> --}}
        {{-- @endif --}}

    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="text-center">
                <table class="table table-striped table-success">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Code</th>
                            <th>Name</th>
                            <th>Prize</th>
                        </tr>
                    </thead>
                    <tbody id="user_lucky">
                        @if (count($userPrize) > 0)
                            @foreach ($userPrize as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->code }}</td>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->prize_name }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <table class="table table-striped table-danger">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Prize</th>
                            <th>Amount</th>
                            <th>Prize structure</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prize as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->prize }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->prize_structure }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@endsection
