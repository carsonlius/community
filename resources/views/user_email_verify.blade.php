@component('mail::message')
# {{ $user->name }} ，您好，欢迎来到carsonlius开发的社区

由于您是新用户, 所以请点击激活按钮,完成账号的验证

@component('mail::button', ['url' => url('/verify/' . $user->confirm_code)])
激活
@endcomponent
<p>如果链接未跳转,请将下面的链接复制到浏览器中打开:http://community.carsonlius.cn/verify/{{ $user->confirm_code }}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent