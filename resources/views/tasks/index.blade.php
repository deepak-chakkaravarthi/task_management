@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Tasks</h1>

    <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
        <div class="row">
            <!-- Filter by Completion Status -->
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="1,0" {{ request('status') == '1,0' ? 'selected' : '' }}>All Statuses</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Complete</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Incomplete</option>
                </select>
            </div>

            <!-- Sort by Due Date -->
            <div class="col-md-4">
                <select name="sort_by" class="form-select">
                    <option value="due_date_asc" {{ request('sort_by') == 'due_date_asc' ? 'selected' : '' }}>Sort by Due
                        Date (Ascending)</option>
                    <option value="due_date_desc" {{ request('sort_by') == 'due_date_desc' ? 'selected' : '' }}>Sort by
                        Due Date (Descending)</option>
                </select>
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </form>




    <!-- Create Task Button -->
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">Create New Task</a>

    @if($tasks->isEmpty())
        <p>No tasks found. You can <a href="{{ route('tasks.create') }}">create a new task</a>.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->status ? 'Complete' : 'Incomplete' }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection