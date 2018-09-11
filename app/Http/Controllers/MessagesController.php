<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Request $request) {
      return view('inbox');
    }
}
