<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Item::all();

        return response()->json([
            'message' => 'Item successfully taken.',
            'data' => $data 
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|integer'
        ]);

        $data = Item::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price
        ]);

        return response()->json([
            'message' => 'Item successfully created.',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|integer'
        ]);

        $data = Item::find($id);
        $data->name = $request->name;
        $data->category = $request->category;
        $data->price = $request->price;
        $data->save();

        return response()->json([
            'message' => 'Item successfully updated.',
            'data' => $data
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        Item::find($id)
        ->delete();

        return response()->json([
            'message' => 'Item successfully deleted.',
        ], 200);
    }
}
