<!-- resources/views/pets/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Dodaj nowe zwierzę</h1>

<form action="{{ route('pets.store') }}" method="POST">
    @csrf
    <label for="name">Nazwa:</label>
    <input type="text" name="name" id="name" required>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="available">Available</option>
        <option value="pending">Pending</option>
        <option value="sold">Sold</option>
    </select>

    <button type="submit" class="btn btn-primary">Dodaj zwierzę</button>
</form>
@endsection
