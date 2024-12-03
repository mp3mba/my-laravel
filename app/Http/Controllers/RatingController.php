<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rateProduct(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Check if the user has already rated the product
        $existingRating = Rating::where('user_id', auth()->id())
                                ->where('product_id', $validated['product_id'])
                                ->first();
    
        if ($existingRating) {
            return response()->json(['message' => 'You have already rated this product.'], 400);
        }
    
        // Create a new rating
        Rating::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'rating' => $validated['rating'],
        ]);
    
        return response()->json(['message' => 'Product rated successfully.'], 200);
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
    public function changeRating(Request $request, $id)
    {
        
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = Rating::where('user_id', auth()->id())
                        ->where('product_id', $validated['product_id'])
                        ->first();

        if (!$rating) {
            return response()->json(['message' => 'Rating not found.'], 404);
        }

        $rating->update([
            'rating' => $validated['rating'],
        ]);

        return response()->json(['message' => 'Rating updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeRating(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        $rating = Rating::where('user_id', auth()->id())
                        ->where('product_id', $validated['product_id'])
                        ->first();
    
        if (!$rating) {
            return response()->json(['message' => 'Rating not found.'], 404);
        }
    
        $rating->delete();
    
        return response()->json(['message' => 'Rating removed successfully.'], 200);
    }
}
