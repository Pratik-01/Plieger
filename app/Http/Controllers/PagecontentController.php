<?php

namespace App\Http\Controllers;

use App\Pagecontent;
use Illuminate\Http\Request;

class PagecontentController extends Controller
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
     * @param  \App\Pagecontent  $pagecontent
     * @return \Illuminate\Http\Response
     */
    public function show(Pagecontent $pagecontent)
    {
        return view('Pagecontent.detail', compact('pagecontent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pagecontent  $pagecontent
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagecontent $pagecontent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pagecontent  $pagecontent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagecontent $pagecontent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pagecontent  $pagecontent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagecontent $pagecontent)
    {
        //
    }
}
