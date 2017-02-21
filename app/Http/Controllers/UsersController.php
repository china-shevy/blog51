<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
class UsersController extends Controller
{
    public function register()
    {
        return view('users.register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRegisterRequest $request)
    {
        // 保存用户数据
        $data = [
            'avatar' => '/images/default-avatar.png',
            'confirm_code' => str_random(48),
            'password' => bcrypt($request->get('password')),
        ];
        $data = array_merge($request->all(),$data);
        // dd($data);
        User::register($data);

        // 重定向回首页
        return redirect('user/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * 验证邮件
     * @param  [type] $confirm_code [description]
     * @return [type]               [description]
     */
    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code',$confirm_code)->first();

        if(is_null($user)){
            return redirect('/');
        }

        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);
        $user->save();

        return redirect('user/login');

    }

    /**
     * 登录页面
     * @return [type] [description]
     */
    public function login()
    {
        return view('users.login');
    }
    /**
     * 登录操作
     * @param  Requests\UserLoginRequest $request [description]
     * @return [type]                             [description]
     */
    public function signin(Requests\UserLoginRequest $request)
    {

        $loginPass = \Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_confirmed' => 1,
        ]);
        if($loginPass) return redirect('/');
        \Session::flash('user_login_failed','密码不正确或邮箱没验证');
        return redirect('user/login')->withInput();
    }

    /**
     * 退出登录
     * @return [type] [description]
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }

    /**
     * 替换头像页面
     * @return [type] [description]
     */
    public function avatar()
    {
        return view('users.avatar');
    }

    /**
     * 保存头像
     * @return [type] [description]
     */
    public function changeAvatar(Request $request)
    {
        // 获取图片
        $file = $request->file('avatar');

        // 验证上传是否成功
        $input = [ 'image' => $file ];
        $rules = [
            'images' => 'image',
        ];
        $validator = \Validator::make($input,$rules);
        if( $validator->fails() ) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray(),
            ]);
        }

        // 保存图片
        $path = 'uploads/';
        $filename = \Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($path, $filename);

        // 修改图片尺寸为宽高200px
        Image::make($path.$filename)->fit(400)->save();

        return response()->json([
            'success' => true,
            'avatar'  => asset($path.$filename),
            'image'  => $path.$filename,
        ]);

    }

    /**
     * 裁剪，保存头像
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function cropAvatar(Request $request)
    {
        $photo = $request->get('photo');
        $width = (int) $request->get('w');
        $height = (int) $request->get('h');
        $xAlign = (int) $request->get('x');
        $yAlign = (int) $request->get('y');

        Image::make($photo)->crop($width,$height,$xAlign,$yAlign)->save();

        // 更新数据
        $user = User::find(\Auth::user()->id);
        $user->avatar = asset($photo);
        $user->save();

        return redirect('user/avatar');
    }
}
