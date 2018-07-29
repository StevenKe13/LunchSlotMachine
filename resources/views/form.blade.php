<div class="row justify-content-md-center">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>店家名稱</strong>
            {!! Form::text('store_name', null, array('placeholder' => '店家名稱','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
        <div class="form-group">
            <strong>地址</strong>
            {!! Form::text('address', null, array('placeholder' => '地址','class' => 'form-control','autocomplete' => 'off')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">送出</button>

        {{-- CSRF 欄位--}}
        {{ csrf_field() }}
    </div>
</div>