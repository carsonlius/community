<?php

namespace App\SendCloud;

use App\User;

class SendCloud
{

    // 模板发送邮件Api
    private $url = 'http://api.sendcloud.net/apiv2/mail/sendtemplate';

    /**
     * @param User $user 用户对象
     * @param string $template 模板名称
     * @param string $subject 主题
     * @param array $params 希望传递的变量 eg: ['%name%' => [$user->name], '%confirm_code%' => [$user->confirm_code]]
     * @return bool|string
     */
    public function sendCloud(User $user, $template, $subject, $params = [])
    {
        // $params = ['%name%' => [$object_user->name], '%route%' => ['verify/' . $object_user->confirm_code]];
        // (new SendCloud())->sendCloud($object_user, 'register', '用户激活账号邮件', $params);
        $x_smtpapi = json_encode(['to' => [$user->email], 'sub' => $params]);

        //您需要登录SendCloud创建API_USER，使用API_USER和API_KEY才可以进行邮件的发送。
        $param = [
            'apiUser' => env('SENDCLOUD_API_USER'),
            'apiKey' => env('SENDCLOUD_API_KEY'),
            'from' => env('SENDCLOUD_FORM'),
            'fromName' => env('SENDCLOUD_FORM_NAME'),
            'subject' => $subject,
            'templateInvokeName' => $template,
            'respEmailId' => 'true',
            'xsmtpapi' => $x_smtpapi
        ];
        $data = http_build_query($param);

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data
            ));

        $context = stream_context_create($options);
        return file_get_contents($this->url, false, $context);
    }
}