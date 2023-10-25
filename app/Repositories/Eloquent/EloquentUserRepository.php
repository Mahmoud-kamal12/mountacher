<?php

namespace App\Repositories\Eloquent;

use App\Contract\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EloquentUserRepository implements UserRepositoryInterface
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
        $user = $this->model->findOrFail($id);
        return $user->update($data) ? $user : throw new \Exception("user not updated");
    }

    public function delete($id)
    {
        $user = $this->model->findOrFail($id);
        return $user->destroy($id);
    }

    public function search($data)
    {
        foreach ($data as $key => $val){
            $this->model = $this->model->where($key,'like',"%{$val}%");
        }
        return $this->model->get();
    }

    public function myEmployees($data)
    {
        foreach ($data as $key => $val){
            $this->model = $this->model->where($key,'like',"%{$val}%");
        }
        $this->model = $this->model->where('manager_id' , auth()->id())->whereRoleIs('employee');
        return $this->model->get();
    }
    public function oneEmployees($id)
    {
        $this->model = $this->model->where('id',$id)->where('manager_id' , auth()->id())->whereRoleIs('employee');
        return $this->model->with('tasks')->get();
    }

    public function myTasks()
    {
        return auth()->user()->tasks;
    }

}
