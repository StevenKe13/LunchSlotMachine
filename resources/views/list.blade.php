@extends('layout.master')

@section('content')

    <div class="container">
        <div calss="raw" style="padding: 25px;">
            <a class="btn btn-primary" href="{{ route('lunch.index') }}"> 返回拉霸頁</a>
            <a href="{{ route('lunch.item.create') }}" title="新增店家" class="btn btn-success">新增店家</a>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="table-responsive" style="background-color: #eeeeee;">
                <table class="table table-striped jambo_table bulk_action table-hover">
                    <thead>
                        <tr class="headings">
                            <th class="column-title">#</th>
                            <th class="column-title">店家</th>
                            <th class="column-title">地址</th>
                            <th class="column-title">新增時間</th>
                            <th class="column-title">動作</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($lunchList as $lunch)
                    <tr>
                        <td class="a-center">{{ ++$i }}</td>
                        <td class="a-center">{{ $lunch->store_name }}</td>
                        <td class="a-center">{{ $lunch->address }}</td>
                        <td class="a-center">{{ $lunch->created_at }}</td>
                        <td class="a-center">
                            <a href="{{ route('lunch.item.edit',$lunch->id) }}" title="編輯" class="btn btn-info" >
                                 編輯
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['lunch.item.destroy', $lunch->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection