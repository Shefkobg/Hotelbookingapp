@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Резервации</h1>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Назад</a>

    <table class="table">
        <thead>
            <tr>
                <th>Номер на резервация</th>
                <th>Номер на стая</th>
                <th>Име</th>
                <th>Телефонен номер</th>
                <th>Дата на настаняване</th>
                <th>Дата на напускане</th>
                <th>Обща сума</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->room->number }}</td>
                <td>{{ $booking->customer->name }}</td>
                <td>{{ $booking->customer->phone_number }}</td>
                <td>{{ $booking->check_in_date }}</td>
                <td>{{ $booking->check_out_date }}</td>
                <td>{{ $booking->total_price }}</td>
                <td>
                    @if($booking->status == 0)
                    Неплатена
                    @elseif($booking->status == 1)
                    Платена
                    @else
                    Отказана
                    @endif
                </td>
                <td>
                    <a href="{{ route('bookings.delete', $booking->id) }}" class="btn btn-danger">Изтрий</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
