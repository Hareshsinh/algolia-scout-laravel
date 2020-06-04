<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if($request->has('search')){
            $users = Contact::search($request->get('search'))->get();
        }else{
            $users = Contact::get();
        }
        return view('index', compact('users'));
    }
}
