<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LetterPadController extends Controller
{
    public function __invoke(){
        return view('invoices.letterpad');
    }
}
