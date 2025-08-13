<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $fileimage = $request->file('image');
            $fileimageName = time() . '_' . uniqid() . '.' . $fileimage->getClientOriginalExtension();
            // Use public_path to get filesystem path for saving
            $destinationPath = public_path('assets/images/productimage');
            // Move the file to the public folder
            $fileimage->move($destinationPath, $fileimageName);
            // Generate URL for storing in DB or showing in frontend
            $filepath = 'assets/images/productimage/' . $fileimageName;
        } else {
            $filepath = $request->image ?? '-';
        }

        try {
            $product = new Product();

            $product->date = Carbon::now();
            $product->category = $request->category;
            $product->productName = $request->productName;
            $product->price = $request->price;
            $product->brand = $request->brand;
            $product->style_no = $request->style_no;
            $product->gauge = $request->gauge;
            $product->count = $request->count;
            $product->construction = $request->construction;
            $product->fabric = $request->fabric;
            $product->image = $filepath;
            $product->status = 1;

            $product->save();
            return response()->json([
                'status' => true,
                'data' => 200,
                'message' => 'Product added successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => 500,
                'message' => 'Something went wrong while saving the contact',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $productlist = Product::where('status', 1)->get();

        if ($productlist->isEmpty()) {
            return response()->json([
                'status' => "false",
                'messages' => 'Retrieved Failed',
                'data' => ""
            ]);
        }

        $defaultImage = asset('images/default-product.jpg'); // store in public/images

        $listData = $productlist->map(function ($pl, $key) use ($defaultImage) {
            return (object) [
                's_no' => $key + 1, // auto increment
                'category' => $pl->category,
                'productname' => $pl->productName,
                'price' => $pl->price,
                'brand' => $pl->brand,
                'styleno' => $pl->style_no,
                'gauge' => $pl->gauge,
                'count' => $pl->count,
                'construction' => $pl->construction,
                'fabric' => $pl->fabric,
                'image' => $pl->image ? asset($pl->image) : $defaultImage
            ];
        });

        return response()->json([
            'status' => "true",
            'messages' => 'Data Retrieved Successfully',
            'data' => $listData
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
