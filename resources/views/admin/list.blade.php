@extends('admin.layout.master')

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
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr class="headings">
                        <th class="column-title">#</th>
                        <th class="column-title">店家</th>
                        <!--
                        <th class="column-title">電話</th>
                        <th class="column-title">地址</th>
                        <th class="column-title" style="width:100px">菜單</th>
                        <th class="column-title">新增時間</th>
                        -->
                        <th class="column-title">狀態</th>
                        <th class="column-title">動作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($lunchList as $lunch)
                        <tr>
                            <td class="a-center">{{ ++$i }}</td>
                            <td class="a-center">
                                <a href="javascript:;" title="查看" class="text-primary"
                                   data-toggle="modal" data-id="{{ $lunch->id }}" data-target="#showDataModal">
                                    {{ $lunch->store_name }}
                                </a>
                            </td>
                        <!--
                            <td class="a-center">{{ $lunch->tel }}</td>
                            <td class="a-center">{{ $lunch->address }}</td>
                            <td class="a-center">
                                @if(($lunch->menu))
                            <a href="{{ asset('public/upload/'.$lunch->menu) }}" target="_blank">
                                        <img src="{{ asset('public/upload/'.$lunch->menu) }}"
                                             class="img-fluid img-thumbnail">
                                    </a>
                                @endif
                                </td>
                                <td class="a-center">{{ $lunch->created_at }}</td>
                            -->
                            <td class="a-center">


                                <input type="checkbox" class="changeStatus"
                                       data-id="{{ $lunch->id }}"
                                       data-toggle="toggle"
                                       data-onstyle="success"
                                       data-size="small"
                                       data-on="開啟"
                                       data-off="關閉"
                                        {{ $lunch->status=='Y' ? 'checked' : '' }}>
                            </td>
                            <td class="a-center">
                                <a href="{{ route('lunch.item.edit',$lunch->id) }}" title="編輯"
                                   class="btn btn-sm btn-info">
                                    編輯
                                </a>
                                {!! Form::open(['method' => 'DELETE','route' => ['lunch.item.destroy', $lunch->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('刪除', ['data-storename'=>$lunch->store_name, 'class' => 'btn btn-sm btn-danger deleteItem']) !!}
                                {!! Form::close() !!}
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showDataModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TITLE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">電話</label>
                        <span class="modal-tel"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">地址</label>
                        <span class="modal-address"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">菜單</label>
                        <img src="" class="modal-menu img-thumbnail">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">新增時間</label>
                        <span class="modal-created_at"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection