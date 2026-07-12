<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use app\Models\LogistikTambang;
use Illuminate\Http\Request;

class LogistikTambangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_logitik = LogistikTambang::all();

        return view('logistik.index', compact('data_logitik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('logistik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
