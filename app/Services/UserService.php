<?php

namespace App\Services;

use App\Contract\UserRepositoryInterface;
use App\Http\Requests\User\CreateTaskRequest;
use App\Http\Requests\User\UpdateTaskRequest;
use Illuminate\Http\Request;

class UserService
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function store(CreateTaskRequest $request){
        $userData = $request->validated();
        $path = $request->file('image')->store('uploads', 'public');
        $userData['image'] = $path;
        $user = $this->userRepo->create($userData);
        $user->attachRole($userData['role']);
        return $user;
    }

    public function update(UpdateTaskRequest $request , $id){
        $userData = $request->validated();
        if ($request->has('image')){
            $path = $request->file('image')->store('uploads', 'public');
            $userData['image'] = $path;
        }
        $user = $this->userRepo->update($userData,$id);
        $user->detachRoles($user->roles->pluck('name')->toArray());
        $user->attachRole($userData['role']);
        return $user;
    }

    public function delete($id){
        return $this->userRepo->delete($id);
    }

    public function search(Request $request){
        $searchData = $request->only(["first_name","last_name"]);
        return $this->userRepo->search($searchData);
    }

    public function myEmployees(Request $request){
        $searchData = $request->only(["first_name","last_name"]);
        return $this->userRepo->myEmployees($searchData);
    }
    public function oneEmployees($id){
        return $this->userRepo->oneEmployees($id);
    }

    public function myTasks(){
        return $this->userRepo->myTasks();
    }

}
