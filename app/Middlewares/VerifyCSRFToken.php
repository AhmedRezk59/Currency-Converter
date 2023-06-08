<?php

namespace App\Middlewares;

use Core\Exceptions\UnAuthorizedRequest;
use Core\Http\Request;
use Core\Interfaces\IMiddleware;
use Core\Session\Session;

class VerifyCSRFToken implements IMiddleware
{
    public function handle()
    {
        if (!Session::get('_token')) {
            Session::set('_token', bin2hex(random_bytes(35)));
        }
        if(Request::method() !== 'GET'){
            if(Session::get('_token') !== Request::post('_token')){
                throw new UnAuthorizedRequest('UnAuthorized');
            }
        }
    }
}
