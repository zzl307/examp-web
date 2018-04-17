@extends('common.login')

@section('content')
    <div class="box">
        <div class="content">
            <form class="form-vertical login-form" action="" method="post">

                {{ csrf_field() }}

                <h3 class="form-title">
                </h3>
                <div class="form-group">
                    <input id="key" type="text" name="key" class="form-control" placeholder="设备连接地址URL example: http://127.0.0.1" value="{{ old('key') }}" required autofocus>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-block">
                        连接
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
