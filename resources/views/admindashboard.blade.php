@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <div class="buttons">
                    <div class="mb-3">
                        <a href="{{ route('rooms.create') }}" class="btn btn-primary">Създай стая</a>
                        <a href="{{ route('rooms') }}" class="btn btn-primary">Стаи</a>
                        <a href="{{ route('bookings.index') }}" class="btn btn-primary">Резервации</a>
                        <a href="{{ route('payments.index') }}" class="btn btn-primary">Плащания</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    body {
        background-color: #FFFBF5;
    }

    .buttons {
    text-align: center;
}

.buttons .btn {
    display: block;
    margin: 10px auto;
}

    .btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    background-color: #f8f9fa;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.login-form {
    background-color: #CBF1F5;
    width: 460.2px;
    height: 300px;
    padding: 30px;
    border-radius: 26px;
    position: relative;
    left: 15%;
    top: 50%;
    left: 50%;
    text-align: center;
    transform: translate(-50%, -15%);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.form-control {
    margin-top: 12px;
    border-radius: 30px;
    padding: 6px;
    font-size: 15px;
    height: auto;
}
.btn-primary {
    color: #7743D8;
    background-color: #C3ACD0;
    border-color: #C3ACD0;
    margin-top: 11px;
    border-radius: 30px;
    width: 331.1px;
    font-weight: bold; 
}
</style>