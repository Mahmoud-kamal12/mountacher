<?php

namespace App\Contract;

interface TaskRepositoryInterface
{
    public function create(array  $data);
    public function update(array $data, $id);
    public function delete($id);

}
