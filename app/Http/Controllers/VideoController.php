<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    //
    public function index(){
        return View::make('videos.index');
    }
}
