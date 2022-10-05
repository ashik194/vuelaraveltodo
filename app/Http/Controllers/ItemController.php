<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Item::latest()->get();
        return response()->json([
            'items' => $items,
            'status' => 200
        ]);
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
        try {
            $items = new Item;
            $items->item_name = $request->input('item_name');
            $items->date = $request->input('date');
            $items->price = $request->input('price');
            $items->completed = $request->input('completed');

            $items->save();

            return response()->json([
                'items' => $items,
                'status' => 200,
                'msg' => 'Item Inserted Successfully....',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $items = Item::findOrFail($id);
        return response()->json([
            'status' => 200,
            'items' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $items = Item::findOrFail($id);
            $items->item_name = $request->input('item_name');
            $items->date = $request->input('date');
            $items->price = $request->input('price');
            $items->completed = $request->input('completed');

            $items->update();

            return response()->json([
                'items' => $items,
                'status' => 200,
                'msg' => 'Item Updated Successfully....',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $items = Item::findOrFail($id);
        $items->delete();
        return response()->json([
            'status' => 200,
            'msg' => 'Item deleted successfully....'
        ]);
    }
}
