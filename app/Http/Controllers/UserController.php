<?php

namespace App\Http\Controllers;

use App\Http\Requests\User;
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
        unset($params['_token']);
        unset($params['password_confirmation']);
        $object_user = \App\User::forceCreate($params);

        // send email
        // subject view confirm_code email
        dump($object_user->toArray());
        dump($object_user->confirm_code);
        $params = ['%name%' => [$object_user->name], '%route%' => ['verify/' . $object_user->confirm_code]];
        (new SendCloud())->sendCloud($object_user, 'register', '用户激活账号邮件', $params);

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

    public function verifyEmail($confirm_code)
    {
        $obj_user = \App\User::where('confirm_code', $confirm_code)->first();
        if (!$obj_user) {
            return redirect('/');
        }
        $obj_user->is_confirmed = 1;

        // 确保原来的链接无效
        $obj_user->confirm_code = str_random(48);
        $obj_user->save();

        // 保存到下个http请求， 保存比较短期的消息（在login页面提示：你的邮箱已经验证,请登录）
        \Session::flash('email_confirm', '你的邮箱已经验证,请登录');

        return redirect('user/login');
    }
}
