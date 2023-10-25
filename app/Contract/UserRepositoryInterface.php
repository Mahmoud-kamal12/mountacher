<?php

namespace App\Contract;

interface UserRepositoryInterface
{
    public function create(array  $data);
    public function update(array $data, $id);
    public function delete($id);

}
