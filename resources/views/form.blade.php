<div class="row justify-content-md-center">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>店家名稱</strong>
            {!! Form::text('store_name', null, array('placeholder' => '店家名稱','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
        <div class="form-group">
            <strong>電話</strong>
            {!! Form::text('tel', null, array('placeholder' => '電話','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
        <div class="form-group">
            <strong>地址</strong>
            {!! Form::text('address', null, array('placeholder' => '地址','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
        <div class="form-group">
            <strong>狀態</strong>
            {!! Form::select('status', array('1' => '開啟', '0' => '關閉'), null, array('class' => 'form-control')); !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-danger" href="{{ route('lunch.item.index') }}"> 取消</a>
        <button type="submit" class="btn btn-primary">送出</button>

        {{-- CSRF 欄位--}}
        {{ csrf_field() }}
    </div>
</div>