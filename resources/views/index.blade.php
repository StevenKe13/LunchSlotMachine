@extends('layout.master')

@section('content')
    <div class="header-line"></div>
    <div id="plane">
        <div class="container">
            <div class="row">

                <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1">

                    <a class="btn btn-primary" href="{{ route('lunch.item.index') }}"> 店家管理</a>

                    <div class="well content">
                        <p>今天午餐就吃...</p>

                        <div id="lunchList">
                            @foreach($lunchList as $lunch)
                                <div class="text-center lunch_item" data-key="{{ $lunch->id }}">
                                    <div class="storeName">{{ $lunch->store_name }}
                                        @if($lunch->menu)
                                            &nbsp;<span style="font-size:12px"><a href="javascript:;"
                                                                  data-toggle="modal"
                                                                  data-target="#menuModal"
                                                                  data-menu="{{ $lunch->menu }}">[菜單]</a></span>
                                        @endif
                                    </div>
                                    <h3 class="storeTel">
                                        @if($lunch->tel)
                                            Tel: {{ $lunch->tel }}
                                        @endif
                                    </h3>
                                    <div class="storeAddress">
                                        <a href="javascript:;"
                                           data-toggle="modal"
                                           data-target="#mapModal"
                                           data-title="{{ $lunch->store_name }}"
                                           data-address="{{ $lunch->address }}">{{ $lunch->address }}
                                            <img src="{{ asset('/public/img/icon_google_map.png') }}"
                                                 style="width:30px"></a>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        {{--<div id="printAddress">--}}
                        {{--<h2>{{ $firstItem['address'] }}</h2>--}}
                        {{--</div>--}}
                    </div>


                    <div class="text-center" style="margin: 15px;">
                        <button id="actBtn" type="button" class="btn btn-success btn-lg" style="margin: 15px;">選擇
                        </button>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 ml-auto">
                                        <div id="map" class="modal-body"></div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Modal -->
                    <div class="modal fade" id="menuModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 ml-auto">
                                        <div class="modal-body"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection