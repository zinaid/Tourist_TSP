<?php

namespace App\Http\Controllers;
use DB;
use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = new Settings();
		$settings = settings::all();
		
		return view('\settings',['settings'=>$settings]);
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
        // novi objekat
        $settings= new Settings();
		DB::table('settings')->delete();
		
		 // dd($request->all());
		// uzima podatke preko requesta i dodjeljuje ih vrijednostima u tabeli
        $settings->population_size=$request->post('population');
        $settings->elitism=$request->get('elitism');
        $settings->mutation_rate=$request->get('mutation');
        $settings->crossover_rate=$request->get('crossover');
        $settings->avoid_highways=$request->get('avoid_mode');
        $settings->travel_mode=$request->get('travel_mode');
        $settings->max_generation=$request->get('generation');
		
		$settings->save();
		
		 return view('index');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
