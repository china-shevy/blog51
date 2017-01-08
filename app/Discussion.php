<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','body','user_id','last_user_id'];

    /**
     * 通过一片帖子获取用户信息
     * @return [array]
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
