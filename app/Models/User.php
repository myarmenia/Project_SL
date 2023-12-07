<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Log\Log;
use App\Traits\FilterTrait;
use App\Traits\NotifiableTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, NotifiableTrait, HasRoles, FilterTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];

    protected $tableFields = ['id', 'username', 'first_name', 'last_name'];

    // protected $hasRelationFields = ['roles'];

    public $relation = [];

    public $relationColumn = [
        'id',
        'username',
        'first_name',
        'last_name'
    ];


    public function logs()
    {
        return $this->hasMany(Log::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function bibliography()
    {
        return $this->hasMany(Bibliography::class);
    }

    public function isAdmin()
    {
        return $this->hasrole('Admin');
    }

    public function hasPermissionThatStartsWith($prefix)
    {
        $rolePermissions = $this->getRolePermissions();
        
        foreach ($rolePermissions as $permission) {
            if (str_starts_with($permission->name, $prefix)) {
                return true;
            }
        }

        return false;
    }

    protected function getRolePermissions()
    {
        return $this->getRoleNames()->flatMap(function ($roleName) {
            return Permission::join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where('role_has_permissions.role_id', $this->roles()->where('name', $roleName)->first()->id)
                ->get();
        });
    }


}
