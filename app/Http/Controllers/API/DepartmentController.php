<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function store(CreateDepartmentRequest $request)
    {
        try {
            $department = $this->departmentService->store($request);
            return Helper::ResponseSuccuss($department);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        try {
            $department = $this->departmentService->update($request,$id);
            return Helper::ResponseSuccuss($department);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->departmentService->delete($id);
            return Helper::ResponseSuccuss();
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $data = $this->departmentService->search($request);
            return Helper::ResponseSuccuss(data:$data);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }
}
