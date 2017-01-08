<?php
namespace App\Mailer;

/**
* 用户发送邮件
*/
class UserMailer extends Mailer
{
	public function register($user)
	{
		$subject = 'Welcome To Phil Home';
		$view = 'test_template_active';
		$data = [
			'%name%' => [$user->name],
			'%url%' => [url('verify').'/'.$user->confirm_code]
		];

		$this->sendTo($user,$subject,$view,$data);
	}
}
