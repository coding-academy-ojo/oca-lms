<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Classroom;
use Illuminate\Http\Request;
use App\user;
use App\Trainee;


class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // to get the academy name that the loged in user in 
        $academyName = optional($user->academy)->name; 
        $trainers = collect();

        switch ($user->role) {
            case 'trainee':
                // Check if the trainee relationship exists and the classroom_id is set
                if ($user->trainee && $user->trainee->classroom_id) {
                    // Fetch the classroom for the trainee
                    $classroom = Classroom::where('id', $user->trainee->classroom_id)
                                          ->with('manager')->first();
                    $classrooms = $classroom ? collect([$classroom]) : collect();
                } else {
                    $classrooms = collect();
                }
                break;
            
            case 'super_manager':
                // Fetch all classrooms with their manager's name and the maneger who has created it
                $classrooms = Classroom::with('manager')->get();

                break;

            case 'manager':
                // Fetch all classrooms created by the manager and the maneger who has created it
                $classrooms = Classroom::where('manager_id', $user->id)->with('manager')->get();
                
                 // Fetch all trainers in the same academy as the manager
                $trainers = User::where('role', 'trainer')
                ->where('academy_id', $user->academy_id)
                ->get();
                break;

            case 'trainer':
                // Fetch all classrooms the trainer is associated with and the maneger who has created it
                $classrooms = Classroom::whereHas('trainers', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->with('manager')->get();
                break;

            default:
                $classrooms = collect();
                break;
        }

        return view('trainer.index', compact('academyName', 'classrooms', 'trainers'));
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
        $user = Auth::user();

        // Create and save the classroom
        $classroom = new Classroom();
        $classroom->name = $request->input('name');
        $classroom->description = $request->input('description');
        $classroom->manager_id = $user->id;
        $classroom->academy_id = $user->academy_id;
        $classroom->picture = $request->input('picture');
        // Add other necessary fields like academy_id, picture, etc.
        $classroom->save();

        // Assign trainers to the classroom
        if($request->has('trainers')) {
            $trainerIds = $request->input('trainers'); // Assuming this is an array of trainer IDs
            foreach($trainerIds as $trainerId) {
                DB::table('classroom_trainer')->insert([
                    'user_id' => $trainerId,
                    'classroom_id' => $classroom->id
                ]);
            }
        }

        return redirect('/classrooms');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
