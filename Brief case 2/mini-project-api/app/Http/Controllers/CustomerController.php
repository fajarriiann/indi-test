<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Customer::all();

        return response()->json([
            'message' => 'Customer successfully taken.',
            'data' => $data 
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'domisili' => 'required',
            'gender' => 'required|in:PRIA,WANITA'
        ]);

        $data = Customer::create([
            'name' => $request->name,
            'domisili' => $request->domisili,
            'gender' => $request->gender
        ]);

        return response()->json([
            'message' => 'Customer successfully created.',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'domisili' => 'required',
            'gender' => 'required|in:PRIA,WANITA'
        ]);

        $data = Customer::find($id);
        $data->name = $request->name;
        $data->domisili = $request->domisili;
        $data->gender = $request->gender;
        $data->save();

        return response()->json([
            'message' => 'Customer successfully updated.',
            'data' => $data
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        Customer::find($id)
        ->delete();

        return response()->json([
            'message' => 'Customer successfully deleted.',
        ], 200);
    }
}
