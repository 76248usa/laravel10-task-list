@extends('layouts.app')

@section('title' , 'List of Tasks')


@section('content')
<div>
    <a href="{{ route('tasks.create') }}">Add Task</a>
</div>
<div>
    @if($tasks) 
        @foreach ($tasks as $task )
            <div>{{ $task->title }}</div>
            
        @endforeach
    @else
        <div>There are no tasks</div> 
    @endif

    @forelse ($tasks as $task)
       <div>
            <a href="{{ route("tasks.show", ["task" => $task->id]) }}">{{ $task->title }}</a>
       </div>
    @empty
        <div>There are no tasks</div>
        
    @endforelse
</div>
@if ($tasks->count())
    <nav>
        {{ $tasks->links() }}
    </nav>
@endif
@endsection
