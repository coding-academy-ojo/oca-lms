<?php

namespace App\Http\Controllers;

use App\TechnologyCategory;
use Illuminate\Http\Request;

class TechnologyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $categories = TechnologyCategory::all();
        return view('technology.technologies', compact('categories'));
    }


    public function indexCohort()
    {
       
        $categories = TechnologyCategory::all();
        return view('technology.rodmap', compact('categories'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TechnologyCategory  $technologyCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TechnologyCategory $category)
    {
         // dd($technologies);
         
        $technologies = $category->technologies;
      
        return view('technology.technology', compact('category', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TechnologyCategory  $technologyCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TechnologyCategory $technologyCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TechnologyCategory  $technologyCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TechnologyCategory $technologyCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TechnologyCategory  $technologyCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechnologyCategory $technologyCategory)
    {
        //
    }
}
