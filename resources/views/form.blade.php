<div class="row justify-content-md-center">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group row">
            <label class="col-md-3">店家名稱</label>
            {!! Form::text('store_name', null, array('placeholder' => '店家名稱','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
        <div class="form-group row">
            <label class="col-md-3">電話</label>
            {!! Form::text('tel', null, array('placeholder' => '電話','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
        <div class="form-group row">
            <label class="col-md-3">地址</label>
            {!! Form::text('address', null, array('placeholder' => '地址','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
        <div class="form-group row">
            <label lass="col-md-3">上傳菜單圖片</label>
            {!! Form::file('menu') !!}
            @if( isset($lunch) )
                <div>
                    <a href="{{ asset('public/upload/'.$lunch->menu) }}" target="_blank">
                        <img src="{{ asset('public/upload/'.$lunch->menu) }}" class="img-thumbnail">
                    </a>
                </div>
            @endif
        </div>
        <div class="form-group row">
            <label lass="col-md-3">店家狀態</label>
            {!! Form::select('status', array('Y' => '開啟', 'N' => '關閉'), null, array('class' => 'form-control')); !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-danger" href="{{ route('lunch.item.index') }}"> 取消</a>
        <button type="submit" class="btn btn-primary">送出</button>

        {{-- CSRF 欄位--}}
        {{ csrf_field() }}
    </div>
</div>