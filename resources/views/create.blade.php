@extends('layout.master')

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>新增店家</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('lunch.item.index') }}"> 返回</a>
            </div>
        </div>
    </div>

    {{-- 錯誤訊息模板元件 --}}
    @include('components.validationErrorMessage')

    {!! Form::open( ['route'=>'lunch.item.store', 'method'=>'POST', 'files'=>true] ) !!}
    @include('form')
    {!! Form::close() !!}

@endsection