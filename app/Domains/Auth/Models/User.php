<?php

namespace App\Domains\Auth\Models;

use App\Domains\Auth\Models\Traits\Attribute\UserAttribute;
use App\Domains\Auth\Models\Traits\Method\UserMethod;
use App\Domains\Auth\Models\Traits\Relationship\UserRelationship;
use App\Domains\Auth\Models\Traits\Scope\UserScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory,
    HasRoles,
    Impersonate,
    Notifiable,
    UserAttribute,
    UserMethod,
    UserRelationship,
    UserScope,
        HasApiTokens;

    public const TYPE_ADMIN = 'Administrator';
    public const TYPE_MANAGER = 'Manager';
    public const TYPE_CASHIER = 'Cashier';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected static $logAttritubes = [
        'name',
        'email',
        'password',
    ];
    protected static $logName = 'User';
    // protected static $logName = 'user';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions', 'roles',
    ];
    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
        'roles',
    ];
    public static function randword($length = 4)
    {
        return substr(str_shuffle("QWERTYUIPASDFGHJKLZXCVBNM23456789"), 0, $length);
    }
}
