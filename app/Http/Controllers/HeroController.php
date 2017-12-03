<?php

namespace App\Http\Controllers;

use App\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroes = Hero::select('id', 'name')->get();
        return $heroes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $heroes = Hero::select('id', 'name')
            ->where('name', 'like', '%' . $name . '%')
            ->get();
        return $heroes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hero = new Hero($request->all());
        $hero->save();
        return $hero->only(['id', 'name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hero = Hero::findOrFail($id);
        return $hero->only(['id', 'name']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function edit(Hero $hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);
        $hero->name = $request->input('name');
        $hero->save();
        return $hero->only(['id', 'name']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();
        return [];
    }
}
