<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Career;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
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




        if ($request->hasFile('file')) {
            $fileimage = $request->file('file');
            $fileimageName = time() . '_' . uniqid() . '.' . $fileimage->getClientOriginalExtension();
            // Use public_path to get filesystem path for saving
            $destinationPath = public_path('assets/images/file');
            // Move the file to the public folder
            $fileimage->move($destinationPath, $fileimageName);
            // Generate URL for storing in DB or showing in frontend
            $filepath = 'assets/images/file/' . $fileimageName;
        } else {
            $filepath = $request->file ?? '-';
        }

        try {
            $career = new Career();


            $career->date = Carbon::now();
            $career->name = $request->name;
            $career->email = $request->email;
            $career->phonenumber = $request->phonenumber;
            $career->file = $filepath;
            $career->skills = $request->skills;
            $career->experience = $request->experience;
            $career->comment = $request->comment;
            $career->status = 1;
            $career->save();
            return response()->json([
                'status' => true,
                'data' => 200,
                'message' => 'Career added successfully'
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
    public function show(string $id)
    {
        //
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
