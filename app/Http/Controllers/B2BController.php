<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\MobileOtp;
use App\LiveClassSubscription;
use App\Model\StateList;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Validator;

class B2BController extends Controller
{
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }

    // create subscriber
    public function index(Request $request) {
       
        return view($this->theme.'.b2b.index');
    }

 
}
