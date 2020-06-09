<?php

namespace LaravelIam\Storage;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LaravelIamUser extends Authenticatable
{
    use Notifiable, HasRoles;

    const ROLE_SUDO = 'sudo';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guard_name = 'web';

    public function __construct()
    {
        parent::__construct();
        $this->table = config('laraveliam.identity_table');
        $this->fillable = [
            config('laraveliam.identity_pk'),
            config('laraveliam.identity_name'),
            config('laraveliam.identity_password')
        ];
    }

    public static function rootUserSetup()
    {
        $role_name = self::ROLE_SUDO;

        $role = Role::updateOrCreate(
            ['name' => trim($role_name), 'guard_name' => 'web'],
            ['name' => trim($role_name), 'guard_name' => 'web']
        );
        $params = [
            'email' => config('laraveliam.sudo_user_pk'),
            'password' => config('laraveliam.sudo_password'),
            'name' => config('laraveliam.sudo_user_name'),
            'roles' => [$role->id]
        ];
        $user = static::userUpdateCreateBasedOnRoles($params);
        return $user;
    }

    public static function resetSudoDefault()
    {
        $user = static::initializeUserSetup();
        return $user;
    }

    public static function userUpdateCreateBasedOnRoles($params, $user_entity = null)
    {
        $user = static::createUpdateUser($params, $user_entity);
        if (isset($params['roles'])) {
            $user->roles()->sync($params['roles']);
        } else {
            $user->roles()->detach();
        }
        return $user;
    }

    public static function createUpdateUser($params, $user_entity = null)
    {
        $update_params = [
            config('laraveliam.identity_pk') => $params['email'],
            config('laraveliam.identity_name') => $params['name']
        ];
        if (trim($params['password']) != "") {
            $update_params[config('laraveliam.identity_password')] = bcrypt($params['password']);
        }
        $user = null;
        if ($user_entity == null) {
            $user = static::updateOrCreate(
                [config('laraveliam.identity_pk') => $params['email']],
                $update_params
            );
        } else {
            $user_entity->update($update_params);
            $user = $user_entity;
        }

        return $user;
    }
    public function scopeExcludeSudo($query)
    {
        return $query->where(config('laraveliam.identity_pk'), '!=', config('laraveliam.sudo_user_pk'));
    }
    public function scopeExcludeAuthUser($query)
    {
        return $query->where(config('laraveliam.identity_pk'), '!=', auth()->user()[config('laraveliam.identity_pk')]);
    }

    public function isIam()
    {
        return $this->hasRole(static::ROLE_SUDO);
    }
}
