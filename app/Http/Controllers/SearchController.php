<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $users = User::search($request->get('search'))->where('is_handyman', true)->take(10)->get();

        return $users;

    }
    public function searchHandymenPaginate(Request $request)
    {
        $users = User::search($request->get('search'))->where('is_handyman', true)->paginate(5);

        return $users;

        // return  response()->json(["message" => "Forbidden"], 403);
    }
}
