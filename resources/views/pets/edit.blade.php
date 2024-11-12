<!-- resources/views/pets/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edytuj zwierzę: {{ $pet['name'] }}</h1>

<form action="{{ route('pets.update', $pet['id']) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Nazwa:</label>
    <input type="text" name="name" id="name" value="{{ $pet['name'] }}" required>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Available</option>
        <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sold</option>
    </select>

    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
</form>
@endsection
