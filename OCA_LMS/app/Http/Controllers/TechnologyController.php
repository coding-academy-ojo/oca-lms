<?php

namespace App\Http\Controllers;

use App\Technology;
use App\TechnologyCategory;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $category)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoryId)
    {

        $category = $categoryId;
        return view('technology.createTechnology', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'technology_category_id' => 'required|exists:technology_categories,id',
            'technologies_name' => 'required|string|max:255',
            'technologies_description' => 'required|string',
            'technologies_resources' => 'required|string',
            'technologies_trainingPeriod' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        // Create a new technology instance
        $technology = new Technology;
        $technology->technology_category_id = $validatedData['technology_category_id'];
        $technology->technologies_name = $validatedData['technologies_name'];
        $technology->technologies_description = $validatedData['technologies_description'];
        $technology->technologies_resources = $validatedData['technologies_resources'];
        $technology->technologies_trainingPeriod = $validatedData['technologies_trainingPeriod'];
        $technology->technologies_photo = $imageName;
        $technology->save();

        // Redirect back or to any other route as needed
        return redirect()->route('categories.show', ['category' => $validatedData['technology_category_id']]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('technology.Technology', compact('technology'));
    }

    public function showInfo(Technology $technology)
    {
        return view('technology.viewtechnology', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        // dd(1);
        return view('technology.editTechnology', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'technologies_name' => 'required|string|max:255',
            'technologies_description' => 'required|string',
            'technologies_resources' => 'required|string',
            'technologies_trainingPeriod' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('path/to/images'), $imageName);
        } else {
            // Keep the existing image if no new one is uploaded
            $imageName = $technology->technologies_photo;
        }

        // Update the technology instance
        $technology->update([
            'technologies_name' => $validatedData['technologies_name'],
            'technologies_description' => $validatedData['technologies_description'],
            'technologies_resources' => $validatedData['technologies_resources'],
            'technologies_trainingPeriod' => $validatedData['technologies_trainingPeriod'],
            'technologies_photo' => $imageName,
        ]);

        // Redirect back or to any other route as needed
        return redirect()->route('technology.showInfo', ['technology' => $technology])->with('success', 'Technology updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('technologies.index')->with('success', 'Technology deleted successfully');
    }
}
