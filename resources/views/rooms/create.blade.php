<!DOCTYPE html>
<html>
<head>
    <title>Създай стая</title>
</head>
<body>
    <div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Назад</a>
        <div class="input-form">
        <h1>Създай нова стая</h1>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('rooms.store') }}">
            @csrf
            <label for="number">Номер на стаята:</label>
            <input type="text" name="number" required>

            <label for="type">Вид на стаята:</label>
            <input type="text" name="type" required>

            <label for="price_per_night">Цена за нощувка:</label>
            <input type="number" name="price_per_night" required>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
            </select>

            <button class="btn-primary" type="submit">Създай стая</button>
        </form>
    </div>
    </div>
</body>
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
    color: #7743D8;
    background-color: #C3ACD0;
    border-color: #C3ACD0;
    margin-top: 11px;
    border-radius: 30px;
    font-size: 24px;
    width: 331.1px;
    font-weight: bold;
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
    padding: 30px;
    border-radius: 26px;
    margin-top: 400px;
    position: relative;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.input-form input[type="text"],
.input-form input[type="number"],
.input-form select {
    margin-top: 12px !important;
    border-radius: 30px !important;
    padding: 6px !important;
    font-size: 15px !important;
    height: auto !important;
    display: block !important;
    margin: 10px auto !important;
}

</style>

</html>

