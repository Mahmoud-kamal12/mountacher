<?php

namespace App\Repositories\Eloquent;

use App\Contract\TaskRepositoryInterface;

class EloquentTaskRepository implements TaskRepositoryInterface
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $task = $this->model->findOrFail($id);
        return $task->update($data) ? $task : throw new \Exception("task not updated");
    }

    public function delete($id)
    {
        $task = $this->model->findOrFail($id);
        return $task->destroy($id);
    }


}
