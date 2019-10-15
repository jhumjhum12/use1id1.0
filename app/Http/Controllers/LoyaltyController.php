<?php

namespace App\Http\Controllers;

use App;
use DB;
use URL;
use Notification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoyaltyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getView()
    {

        $fakeData =
        [
            [
                "name"=>"Albert Heijin",
                "logo"=>URL::asset('img/fake-img/albert.jpg'),
                "barcode"=>URL::asset('img/fake-img/albert-barcode.jpg'),
            ],
            [
                "name"=>"BIO-Planet",
                "logo"=>URL::asset('img/fake-img/bio-planet.jpg'),
                "barcode"=>URL::asset('img/fake-img/bioplanet-barcode.jpg'),
            ],
            [
                "name"=>"Carrefour",
                "logo"=>URL::asset('img/fake-img/carrefour.jpg'),
                "barcode"=>URL::asset('img/fake-img/carrefour-barcode.jpg'),
            ],
            [
                "name"=>"Colruyt",
                "logo"=>URL::asset('img/fake-img/colruyt.jpg'),
                "barcode"=>URL::asset('img/fake-img/colruyt-barcode.jpg'),
            ],
            [
                "name"=>"Hubo",
                "logo"=>URL::asset('img/fake-img/hubo.jpg'),
                "barcode"=>URL::asset('img/fake-img/hubo-barcode.jpg'),
            ],
            [
                "name"=>"Lyoness",
                "logo"=>URL::asset('img/fake-img/lyoness.jpg'),
                "barcode"=>URL::asset('img/fake-img/lyoness-barcode.jpg'),
            ],
        ];

        return view("member.loyalty.view")
            ->with('cards', $fakeData);

    }


}
