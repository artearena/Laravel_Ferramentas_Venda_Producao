<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('consulta-cep');
    }

    public function consulta_cep()
    {
        return view('consulta-cep');
    }
    public function bandeiras()
    {

        return view('bandeiras');
    }
}
