<?php

namespace App\Services;

use App\Contract\TaskRepositoryInterface;
use App\Http\Requests\User\CreateTaskRequest;
use App\Http\Requests\User\UpdateTaskRequest;

class TaskService
{

    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function store(CreateTaskRequest $request){
        $taskData = $request->validated();
        return $this->taskRepository->create($taskData);

    }

    public function update(UpdateTaskRequest $request , $id){
        $taskData = $request->validated();
        return $this->taskRepository->update($taskData,$id);
    }

}
