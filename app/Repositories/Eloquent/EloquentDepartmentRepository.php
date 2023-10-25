<?php

namespace App\Repositories\Eloquent;

use App\Contract\DepartmentRepositoryInterface;
use App\Models\Department;

class EloquentDepartmentRepository implements DepartmentRepositoryInterface
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
        $department = $this->model->findOrFail($id);
        return $department->update($data) ? $department : throw new \Exception("department not updated");
    }

    public function delete($id)
    {
        $department = $this->model->findOrFail($id);
        if($department->users->isEmpty()){
            return $department->destroy($id);
        }
        throw new \Exception("Can't delete department it have employee");
    }

    public function search($data)
    {
//        return $this->model->select('departments.*')
//            ->selectRaw('count(users.id) as employee_count')
//            ->where('departments.name' ,'like', "%{$data['name']}%")
//            ->selectRaw('sum(users.salary) as total_salary')
//            ->leftJoin('users', 'users.department_id', '=', 'departments.id')
//            ->groupBy('departments.id')
//            ->get();

        foreach ($data as $key => $val){
            $this->model = $this->model->where($key,'like',"%{$val}%");
        }
        return $this->model->withCount('users')->withSum('users', 'salary')->get();
    }

}
