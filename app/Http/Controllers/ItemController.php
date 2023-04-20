<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = User::find(auth()->id())->items;


        return inertia('Dashboard', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return inertia('CreateItem');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:20',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        User::find(auth()->id())->items()->create($validate);

        return back();
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

        $validate = $request->validate([
            'name' => 'required|string|max:20',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
        Item::whereId($id)->update($validate);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Item::find($id)->delete();
        return back();
    }
}
