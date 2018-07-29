@extends('layout.master')

@section('content')

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="pull-left">
                <h2>新增店家</h2>
            </div>
        </div>

        {{-- 錯誤訊息模板元件 --}}
        @include('components.validationErrorMessage')

        {!! Form::open( ['route'=>'lunch.item.store', 'method'=>'POST', 'files'=>true] ) !!}
        @include('form')
        {!! Form::close() !!}
    </div>

@endsection