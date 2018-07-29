@extends('layout.master')

@section('content')
    <div class="header-line"></div>
    <div id="plane">
        <div class="container">
            <div class="row">

                <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1">
                    <div class="well content">
                        <p>今天午餐就吃...</p>

                        <div id="lunchList">
                            @foreach($lunchList as $lunch)
                            <div class="text-center">
                                {{ $lunch->store_name }}
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-center" style="margin: 15px;">
                        <button id="actBtn" type="button" class="btn btn-success btn-lg" style="margin: 15px;">選擇</button>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection