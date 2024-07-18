<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all(); // Fetch all todos from the database
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // Set a default value for 'is_completed'
    $validatedData['is_completed'] = false; // Set default value

    // Create a new todo using mass assignment
    Todo::create($validatedData);

    // Redirect back to the todos index with a success message
    return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
}


    public function edit($id)
    {
        $todo = Todo::findOrFail($id); // Find the todo by ID
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Find the todo and update it
        $todo = Todo::findOrFail($id);
        $todo->update($validatedData);

        // Redirect back to the todos index with a success message
        return redirect()->route('todos.index')->with('success', 'Todo updated successfully!');
    }

    public function destroy($id)
    {
        // Find the todo and delete it
        $todo = Todo::findOrFail($id);
        $todo->delete();

        // Redirect back to the todos index with a success message
        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully!');
    }
}
