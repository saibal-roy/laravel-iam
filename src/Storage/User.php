<?php

namespace LaravelIam\Storage;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guard_name = 'web';

    public function __construct() {
        parent::__construct();
        $this->table = config('laraveliam.identity_table');
        $this->fillable = [
            config('laraveliam.identity_pk'), 
            config('laraveliam.identity_name'), 
            config('laraveliam.identity_password')
        ];
    
    }    

    public static function initializeUserSetup()
    {
        $user = self::where(config('laraveliam.identity_pk'), 
        '=', config('iamconstants.sudo_user_pk'))->first();
        if($user) return $user;
                
        $role = config('iamconstants.sudo_user_role');
        // Seed the default permissions
        $role = Role::firstOrCreate(['name' => trim($role), 'guard_name' => 'web'], ['name' => trim($role), 'guard_name' => 'web']);

        $user = self::updateOrCreate(
            [config('laraveliam.identity_pk')=> config('iamconstants.sudo_user_pk')], 
            [
                config('laraveliam.identity_pk')=> config('iamconstants.sudo_user_pk'),
                config('laraveliam.identity_password')=> bcrypt(config('iamconstants.sudo_password')),
                config('laraveliam.identity_name') => config('iamconstants.sudo_user_name')
            ]
        );
        $user->assignRole($role->name);

        return $user;
    }

    public static function resetSudoDefault()
    {
        $user = self::where(config('laraveliam.identity_pk'), 
        '=', config('iamconstants.sudo_user_pk'))->first();
        if($user) 
        {
            $user->password = bcrypt(config('iamconstants.sudo_password'));
            $user->save();
            return $user;
        }
    }

}
