<?php
namespace App\Repository;
interface Repository {
    public function create(array $data);
    public function destroy(int $id);
    public function update(int $id, array $data);
}
