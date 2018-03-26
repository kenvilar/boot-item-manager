<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
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
        $validator = Validator::make($request->all(), [
        	'text' => 'required',
	        'body' => 'required',
        ]);

        if ($validator->fails()) {
	        $response[] = ['response' => $validator->messages(), 'success' => false];

	        return $response;
        } else {
	        $item = new Item;
	        $item->text = $request->input('text');
	        $item->body = $request->input('body');
	        $item->save();

	        return response()->json($item);
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
        $item = Item::all()->find($id);

        return response()->json($item);
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
	    $validator = Validator::make($request->all(), [
		    'text' => 'required',
		    'body' => 'required',
	    ]);

	    if ($validator->fails()) {
		    $response[] = ['response' => $validator->messages(), 'success' => false];

		    return $response;
	    } else {
		    $item = Item::query()->find($id);
		    $item->text = $request->input('text');
		    $item->body = $request->input('body');
		    $item->update();

		    return response()->json($item);
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
        $item = Item::query()->find($id);
        $item->delete();

	    $response[] = ['response' => 'Item deleted successfully!', 'success' => true];

	    return $response;
    }
}
