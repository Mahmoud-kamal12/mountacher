<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateTaskRequest;
use App\Http\Requests\User\UpdateTaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{

    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(CreateTaskRequest $request)
    {
        try {
            $task = $this->taskService->store($request);
            return Helper::ResponseSuccuss($task);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $task = $this->taskService->update($request , $id);
            return Helper::ResponseSuccuss($task);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }
}
