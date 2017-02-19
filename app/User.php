<?php

namespace App;

use Mail;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','avatar','confirm_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * 获取一个user的所有discussion
     *
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class); 
    }

    /**
     * 获取一个user的所有comment
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 用户注册
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public static function register(array $attributes)
    {
        $user = static::create($attributes);

        // 发送邮件
        event(new Events\UserRegistered($user));

        return $user;
    }

}
