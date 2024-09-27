<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRating;
use App\Models\User;
use App\Models\Product;
use DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = User::join('user_ratings', 'users.id', '=', 'user_ratings.user_id')
        ->select('user_ratings.rating', 'users.*')
        ->get();

        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $rating = new UserRating;
        $product = new Product;

        $validateRating = $request->valodate([
            'rating' => 'numeric|unique::user_ratings'
        ]);

        $userRating = DB::create([
            'rating' => $request['rating'],
            'rating_datetime' => $request['rating_datetime'],
        ]);

        return response()->json(["message" => 'Saved successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rating = find::UserRating($id);

        if($rating)
        {
            DB::update([
                'rating' => 'name',
                'rating_datetime' => 'rating_datetime',
            ]);

            return response()->json(["message" => 'updated successfull']);
        }

        return response()->json(["message" => 'updated was notsuccessfull']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rating = find::UserRating($id);

        if($rating)
        {
            $rating->delete();
            return response()->json(['message' => 'deleted successful']);
        }

        return response()->json(['message' => 'deleted unsuccessful']);

    }
}
