@extends('layouts.app')

@section('content')
@if (Auth::check())
    <form method="POST" action="{{ route('logout') }}">
        @csrf
    </form>
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="input-form">
                <form method="POST" action="{{ route('rooms.reserve') }}">
                    @csrf
                    <div class="form-group">
                        <label for="room_id">Избери стая:</label>
                        <select name="room_id" id="room_id" class="form-control">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room_type">Тип стая:</label>
                        <input type="text" id="room_type" name="room_type" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="price_per_night">Цена на нощувка:</label>
                        <input type="text" id="price_per_night" name="price_per_night" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="check_in_date">Дата на настаняване:</label>
                        <input type="date" id="check_in_date" name="check_in_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="check_out_date">Дата на напускане:</label>
                        <input type="date" id="check_out_date" name="check_out_date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Резервирай</button>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                </form>
</div>
                <div class="tables">
                <button class="btn btn-link custom-button" type="button" data-collapse-target="#reservationsTable">
    Мои резервации
</button>
<div class="custom-collapse" id="reservationsTable">
                    <h2>Мои резервации</h2>
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Номер на резервация</th>
                            <th>Дата на настаняване</th>
                            <th>Дата на напускане</th>
                            <th>Обща сума</th>
                            <th>Платена сума</th>
                            <th>Оставаща сума</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->check_in_date }}</td>
                                <td>{{ $booking->check_out_date }}</td>
                                <td>{{ $booking->total_price }}</td>
                                <td>{{ $booking->payments->sum('amount') }}</td>
                                <td>{{ $booking->total_price - $booking->payments->sum('amount') }}</td>
                                <td>
                                    @if($booking->status == 0)
                                        Неплатена
                                    @else
                                        Платена
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('booking.pay', $booking->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="payment_amount">Сума за плащане:</label>
                                            <input type="text" id="payment_amount" name="payment_amount" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-success">Плати</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>

                <button class="btn btn-link custom-button" type="button" data-collapse-target="#paymentsTable">
                    Мои плащания
                </button>
                <div class="custom-collapse" id="paymentsTable">
                    <h2>Мои плащания</h2>
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Номер на плащане</th>
                            <th>Номер на резервация</th>
                            <th>Сума на плащането</th>
                            <th>Дата на плащането</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>
                                    @if ($payment->booking)
                                        {{ $payment->booking->id }}
                                    @else
                                        Няма свързана резервация
                                    @endif
                                </td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->payment_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
</div>
                <div class="card-body">
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #FFFBF5;
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
.custom-button {
    background-color: #FF0000;
    color: #FFFFFF;
}

.custom-collapse {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
}

.custom-collapse.expanded {
    max-height: 1000px;
}

.custom-button {
    background-color: #C3ACD0;
    color: #7743D8;
    margin-bottom: 12px;
    border-radius: 30px;
    width: 522px;
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
    // JavaScript/jQuery
$(document).ready(function () {
    $('.custom-button').click(function () {
        var targetId = $(this).data('collapse-target');
        var $target = $(targetId);

        if ($target.hasClass('expanded')) {
            $target.removeClass('expanded');
        } else {
            $target.addClass('expanded');
        }
    });
});

    </script>
<!-- Включване на Bootstrap CSS и JavaScript, както и jQuery -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

@endsection
