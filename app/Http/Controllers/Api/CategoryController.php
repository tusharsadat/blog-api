<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->get();
        return response()->json([
            'success' => 'true',
            'message' => 'successfully data retrived',
            'data' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'category_name' => 'required|string|unique:categories',
        ]);

        if ($data->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error',
                    'erroe' => $data->getMessageBag(),
                ],
                422
            );
        }

        $formData = $data->validated();
        $formData['slug'] = Str::slug($formData['category_name']);

        $category = Category::create($formData);

        return response()->json(
            [
                'success' => true,
                'message' => 'successfuly category created',
                'data' => $category,
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'category not found',
                ],
                404
            );
        } else {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'successful',
                    'data' => $category,
                ],
                200
            );
        }
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
        $category = Category::find($id);

        if (!$category) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'category not found',
                ],
                404
            );
        }

        $data = Validator::make($request->all(), [
            'category_name' => 'required|string|unique:categories,category_name,' . $category->id,
        ]);

        if ($data->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error',
                    'erroe' => $data->getMessageBag(),
                ],
                422
            );
        }

        $formData = $data->validated();
        $formData['slug'] = Str::slug($formData['category_name']);

        $category->update($formData);

        return response()->json(
            [
                'success' => true,
                'message' => 'successfuly category updated',
                'data' => $category,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'category not found',
                ],
            );
        }
        $category->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'successfuly category deleted',

            ],
        );
    }
}
