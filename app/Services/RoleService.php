<?php
namespace App\Services;

use App\Models\User;

class RoleService extends BaseService
{
    public function assignRole(User $user, string $role): void
    {
        $user->assignRole($role);
    }
    
    public function removeRole(User $user, string $role): void
    {
        $user->removeRole($role);
    }
}
