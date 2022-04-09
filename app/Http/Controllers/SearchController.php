<?php

namespace App\Http\Controllers;
use App\Models\Gig;
use App\Models\Category;
use App\Models\User;
use App\Models\ClientRequest;


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


    public function searchHandymen(Request $request)
    {
        $users = User::search($request->get('search'))->where('is_handyman', true)->get();

        return $users;

        // return  response()->json(["message" => "Forbidden"], 403);
    }


    public function searchFunction (Request $request)
    {
        $gigs = Gig::search($request->get('search'))->take(5)->get();
        $clientRequests = ClientRequest::search($request->get('search'))->take(5)->get();
        $users = User::search($request->get('search'))->where('is_handyman', true)->get();
        $categories = Category::search($request->get('search'))->take(5)->get();
        $searchResult = array();
        $searchResult["requests"] = $clientRequests;
        $searchResult["handymen"] = $users;
        $searchResult["categories"] = $categories;

        $gigsData = array();


        foreach ($gigs as $gig) {
           $img =  $gig->images;
            //put the data in an object
               array_push(    $gigsData ,  array(

                   'data' => $gig,
                   'images' => $img ,

                )
              );

        }

        $searchResult["gigs"] = $gigsData;
        return $searchResult;


    }

    public function  searchGigs (Request $request)
    {
        $gigs = Gig::search($request->get('search'))->get();

        return $gigs;

        // return  response()->json(["message" => "Forbidden"], 403);
    }
    public function    searchGigsPaginate (Request $request)
    {
        $gigs = Gig::search($request->get('search'))->paginate(5);

        return $gigs;

        // return  response()->json(["message" => "Forbidden"], 403);
    }
     public function searchClientRequest (Request $request)
    {
        $clientRequests = ClientRequest::search($request->get('search'))->get();

        return $clientRequests;

        // return  response()->json(["message" => "Forbidden"], 403);

    }
    public function searchClientRequestPaginate (Request $request)
    {
        $clientRequests = ClientRequest::search($request->get('search'))->paginate(5);

        return $clientRequests;

        // return  response()->json(["message" => "Forbidden"], 403);

    }

}
