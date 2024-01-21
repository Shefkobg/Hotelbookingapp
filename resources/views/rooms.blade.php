@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Стаи</h1>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Назад</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Номер</th>
                <th>Тип</th>
                <th>Цена на нощувка</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>{{ $room->id }}</td>
                <td>{{ $room->number }}</td>
                <td>{{ $room->type }}</td>
                <td>{{ $room->price_per_night }}</td>
                <td>{{ $room->status }}</td>
                <td>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Изтрий</button>
                    </form>
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
