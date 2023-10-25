<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateTaskRequest;
use App\Http\Requests\User\UpdateTaskRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected UserService $userServices;

    public function __construct(UserService $userServices)
    {
        $this->userServices = $userServices;
    }

    public function store(CreateTaskRequest $request)
    {
        try {
            $user = $this->userServices->store($request);
            return Helper::ResponseSuccuss($user);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }


    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $user = $this->userServices->update($request , $id);
            return Helper::ResponseSuccuss($user);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $user = $this->userServices->delete($id);
            return Helper::ResponseSuccuss();
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $data = $this->userServices->search($request);
            return Helper::ResponseSuccuss(data:$data);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function myEmployees(Request $request)
    {
        try {
            $data = $this->userServices->myEmployees($request);
            return Helper::ResponseSuccuss(data:$data);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function oneEmployees(Request $request , $id)
    {
        try {
            $data = $this->userServices->oneEmployees($id);
            return Helper::ResponseSuccuss(data:$data);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

    public function myTasks(Request $request)
    {
        try {
            $data = $this->userServices->myTasks();
            return Helper::ResponseSuccuss(data:$data);
        }catch (\Exception $exception){
            return Helper::ResponseError(msg: $exception->getMessage());
        }
    }

}
