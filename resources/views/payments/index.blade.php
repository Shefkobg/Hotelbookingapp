@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Payments') }}
                    <a href="{{ url()->previous() }}" class="btn float-right">Назад</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking ID</th>
                                <th>Сума</th>
                                <th>Дата на плащане</th>
                                <th>Потребител</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->booking_id }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->payment_date }}</td>
                                <td>
                                    @if ($payment->user)
                                        {{ $payment->user->name }}
                                    @else
                                        Няма свързан потребител
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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

.input-form {
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

.tables {
    margin: 0 auto;
    width: 80%;
    text-align: center;
}

.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 20px;
}

.table th, .table td {
    padding: 10px;
    text-align: center;
}

.table th {
    background-color: #007bff;
    color: #fff;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tbody tr:hover {
    background-color: #d3d3d3;
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

.table th {
    background-color: #C3ACD0;
    color: #7743D8;
}
</style>
