@extends('layout.master')

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>修改店家</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('lunch.item.index') }}"> 返回</a>
            </div>
        </div>
    </div>

    {{-- 錯誤訊息模板元件 --}}
    @include('components.validationErrorMessage')

    {!! Form::model($lunch, ['method'=>'PATCH', 'route'=>['lunch.item.update', $lunch->id], 'files'=>true ]) !!}
    @include('form')
    {!! Form::close() !!}

@endsection