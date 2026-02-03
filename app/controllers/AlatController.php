<?php
require_once __DIR__ . '/../models/Alat.php';
require_once __DIR__ . '/../middleware/role.php';

class AlatController
{
    public static function index(): array
    {
        allow_roles(['admin']);
        return Alat::all();
    }

    public static function store(array $data): bool
    {
        allow_roles(['admin']);
        return Alat::create($data);
    }

    public static function update(int $id, array $data): bool
    {
        allow_roles(['admin']);
        return Alat::update($id, $data);
    }

    public static function destroy(int $id): bool
    {
        allow_roles(['admin']);
        return Alat::delete($id);
    }
}
