
<?php
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function (Task $task) {
   
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
         
    ]);
    dd('tasks');
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

Route::post('/tasks', function (Task $task, TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::put('/tasks/{task}/toggle-complete', function(Task $task){
    $task->completed = !$task->completed;
    $task->save();
    return redirect()->back()->with('success', 'Task Completed');

})->name('tasks.toggle-complete');

// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('hello');
// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });
// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });
Route::fallback(function () {
    return 'Still got somewhere!';
});









