@extends('layout.master')

@section('content')

    <div class="row justify-content-md-center">
        <div class="pull-left">
            <h2>修改店家</h2>
        </div>
    </div>

    {{-- 錯誤訊息模板元件 --}}
    @include('components.validationErrorMessage')

    {!! Form::model($lunch, ['method'=>'PATCH', 'route'=>['lunch.item.update', $lunch->id], 'files'=>true ]) !!}
    @include('form')
    {!! Form::close() !!}

@endsection