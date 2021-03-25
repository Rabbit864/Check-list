@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <a href="{{ route('redirect-google') }}" class="btn btn-primary">Войти с помощью Google</a>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
