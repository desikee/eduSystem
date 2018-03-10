<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Http\Request;

class VueController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('vue.index');
    }
}
