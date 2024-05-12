<?php


namespace App\Hps;


class Social
{
    static function graphFacebook (string $url, $type = 'GET', $data = [])
    {
        $ch = curl_init();
        if ($type === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        // Return the output instead of displaying it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Execute the curl session
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            return false;
        }



        // Close the curl session
        curl_close($ch);
        // Return the output as a variable
        return json_decode($result);
    }

    static function urlLongLiveAccessToken(): string
    {
        return 'https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id='.env('FACEBOOK_CLIENT_ID').'&client_secret='.env('FACEBOOK_CLIENT_SECRET').'&fb_exchange_token='.env('SHORT_LIVED_TOKEN');
    }

    static function generatingAppAccessToken(): string
    {
        return 'https://graph.facebook.com/oauth/access_token?client_id='.env('FACEBOOK_CLIENT_ID').'&client_secret='.env('FACEBOOK_CLIENT_SECRET').'&&grant_type=client_credentials';
    }

    static function urlUserInfo($id, $token): string
    {
        return 'https://graph.facebook.com/v12.0/'.$id.'/?fields=id,name,email,picture&access_token='.$token;
    }

    static function urlSendMessage($id, $token): string
    {
        return 'https://graph.facebook.com/v12.0/me/messages?access_token='.$token;
    }

    static function urlShortLiveAccessToken(): string
    {
        return 'https://graph.facebook.com/oauth/access_token?client_id='.env('FACEBOOK_CLIENT_ID').'&client_secret='.env('FACEBOOK_CLIENT_SECRET').'&&grant_type=client_credentials';
    }
}
