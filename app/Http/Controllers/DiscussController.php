<?php

namespace App\Http\Controllers;

use App\Discuss;
use Illuminate\Http\Request;

class DiscussController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Discuss $discussion
     * @return \Illuminate\Http\Response
     * @internal param Discuss $discuss
     */
    public function show(Discuss $discussion)
    {
        return view('forum.show')->with(compact('discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discuss  $discuss
     * @return \Illuminate\Http\Response
     */
    public function edit(Discuss $discuss)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discuss  $discuss
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discuss $discuss)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discuss  $discuss
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discuss $discuss)
    {
        //
    }
}