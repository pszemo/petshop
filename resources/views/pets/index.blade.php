<!-- resources/views/pets/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Lista zwierząt</h1>
<a href="{{ route('pets.create') }}" class="btn btn-primary">Dodaj nowe zwierzę</a>

<ul>
    @foreach($pets as $pet)
        <li>
            <strong>{{ $pet['name'] ?? 'Brak nazwy' }}</strong> - {{ $pet['status'] ?? 'Brak statusu' }}

            <a href="{{ route('pets.edit', $pet['id']) }}">Edytuj</a>
            <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Usuń</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
