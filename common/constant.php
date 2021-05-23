<?php
namespace Common;

class Constant {
    static string $ggTokenVerifyEndpoint = 'https://oauth2.googleapis.com/tokeninfo?id_token=';
    static string $fbTokenVerifyEndpoint = 'https://graph.facebook.com/v10.0/me?fields=id,first_name,last_name,email,picture.type(normal)&access_token=';
}