@extends('layouts.app')

@section('content')
    <h1>Todo List</h1>

    @if($todos->isEmpty())
        <p class="alert alert-info">No todos found. <a href="{{ route('todos.create') }}">Create one now!</a></p>
    @else
        <ul class="list-group">
            @foreach($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{ $todo->title }}</h5>
                        <p>{{ $todo->description }}</p>
                    </div>
                    <div>
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('todos.create') }}" class="btn btn-primary mt-4">Create New Todo</a>
@endsection
