<?php

namespace App\Services;

use App\Contract\DepartmentRepositoryInterface;
use App\Contract\UserRepositoryInterface;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\CreateUserRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Requests\Department\UpdateUserRequest;
use Illuminate\Http\Request;

class DepartmentService
{

    protected  $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function store(CreateDepartmentRequest $request){
        $departmentData = $request->validated();
        return $this->departmentRepository->create($departmentData);
    }

    public function update(UpdateDepartmentRequest $request , $id){
        $departmentData = $request->validated();
        return $this->departmentRepository->update($departmentData,$id);
    }

    public function delete($id){
        return $this->departmentRepository->delete($id);
    }

    public function search(Request $request){
        $searchData = $request->only(["name"]);
        return $this->departmentRepository->search($searchData);
    }
}
