<?php

namespace App\Http\Controllers;

use App\Http\Requests\User;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\SendCloud\SendCloud;

class UserController extends Controller
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
     * @param User $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(User $request)
    {
        $confirm_code = str_random(48);
        $params = $request->toArray() + ['avatar' => '/image/googlelogo_color_272x92dp.png', 'confirm_code' => $confirm_code];
        \App\User::create($params);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * verify email code
     * @param $confirm_code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyEmail($confirm_code)
    {
        $obj_user = \App\User::where('confirm_code', $confirm_code)->first();
        if (!$obj_user) {
            return redirect('/');
        }
        $obj_user->is_confirmed = 1;

        // make old confirm_code disappear
        $obj_user->confirm_code = str_random(48);
        $obj_user->save();

        // 保存到下个http请求， 保存比较短期的消息（在login页面提示：你的邮箱已经验证,请登录）
        \Session::flash('email_confirm', '你的邮箱已经验证,请登录');
        return redirect('/login');
    }

    public function login()
    {
        return view('users.login');
    }

    public function sign(UserLoginRequest $request)
    {
        $attempt = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_confirmed' => 1
        ];
        if (\Auth::attempt($attempt)) {
            return redirect('/');
        }

        \Session::flash('user_login_failed', '密码不正确或者邮箱没有验证');
        return redirect('/login')->withInput();
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
