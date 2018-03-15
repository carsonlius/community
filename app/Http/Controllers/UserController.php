<?php

namespace App\Http\Controllers;

use App\Http\Requests\User;
use App\Http\Requests\UserLoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Overtrue\Socialite\SocialiteManager;

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

    /**
     * login
     * @param UserLoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sign(UserLoginRequest $request)
    {
        $attempt = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_confirmed' => 1
        ];
        if (\Auth::attempt($attempt)) {
            // 跳转到登陆之前的页面
            if (\Session::has('redirect_url')) {
                $redirect_url = \Session::get('redirect_url');
                \Session::forget('redirect_url');
                return redirect($redirect_url);
            }
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

    public function showAvatar()
    {
        return view('users.avatar');
    }

    public function storeAvatar(Request $request)
    {
        // validator
        $rules = [
            'avatar' => [
                'required',
                'image'
            ]
        ];
        $messages = [
            'avatar.required' => '请上传头像',
            'avatar.image' => '请上传正常格式的头像'
        ];
        $validator = \Validator::make($request->toArray(), $rules, $messages);
        if ($validator->fails()) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        // upload photo
        $file = $request->file('avatar');
        $destinationPath = 'uploads/';
        $filename = \Auth::id() . '_' . time() . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        // adjust photo
        Image::make($destinationPath . $filename)->fit(400)->save();
        \Auth::user()->update(['avatar' => '/' . $destinationPath . $filename]);

        return \Response::json([
            'success' => true,
            'avatar' => '/' . $destinationPath . $filename
        ]);
    }

    public function cropAvatar(Request $request)
    {
        // crop photo
        $photo = substr($request->get('photo'), 1);
        $width = (int)$request->get('w');
        $height = (int)$request->get('h');
        $x = (int)$request->get('x');
        $y = (int)$request->get('y');
        \Image::make($photo)->crop($width, $height, $x, $y)->save();
        return redirect('/user/showAvatar');
    }

    /**
     * github 跳转认证的入口
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function thirdLogin()
    {
        $uri = \Request::route()->uri;
        $driver = explode("/", $uri)[0];

        $socialite = new SocialiteManager(config('services'));
        return $socialite->driver($driver)->redirect();
    }

    /**
     * github callback
     */
    public function thirdCallback()
    {
        $uri = \Request::route()->uri;
        $driver = explode("/", $uri)[0];

        // oauth
        $socialite = new SocialiteManager(config('services'));
        $user = $socialite->driver($driver)->user();

        // register for the first time or not base on social_type and social
        $social_type = strtolower($user->getProviderName());
        $social_id = $user->getId();
        $email = $user->getEmail();

        // determine this email is registered
        $email_register = \App\User::where(compact('email'))->first();

        $web_user = \App\User::where(compact('social_id', 'social_type'))->first();
        if (!$web_user && !$email_register) {
            // register data  new one
            $params = [
                'name' => $user->getNickname(),
                'email' => ($email ?: mt_rand(100, 200) . 'suiji@163.com'),
                'password' => bcrypt(str_random(16)),
                'confirm_code' => bcrypt(str_random(32)),
                'avatar' => $user->getAvatar(),
                'is_confirmed' => 1,
                'social_id' => $social_id,
                'social_type' => $social_type
            ];
            $web_user = \App\User::create($params);
        } elseif ($email_register && !$web_user) {
            // 邮箱已经被注册 但是这个第三方登录没有用过 则直接绑定
            $email_register->update(compact('social_type', 'social_id'));
        }

        // login
        \Auth::login($web_user);
        // 跳转到登陆之前的页面
        if (\Session::has('redirect_url')) {
            $redirect_url = \Session::get('redirect_url');
            \Session::forget('redirect_url');
            return redirect($redirect_url);
        }
        return redirect('/');
    }
}
