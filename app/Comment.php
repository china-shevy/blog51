<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['body','user_id','discussion_id'];

	/**
	 * 通过评论返回用户信息
	 * @return [type] [description]
	 */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
