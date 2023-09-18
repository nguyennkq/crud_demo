<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = category::query()->latest()->get();
        return view('category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $model = new category();
            $model->fill($request->all());
            $model->save();
            $notification = array(
                "message" => "Add category successfully",
                "alert-type" => "success",
            );
            return to_route('category.index')->with($notification);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $notification = array(
                "message" => "Add category unsuccessfully",
                "alert-type" => "error",
            );
            return back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = category::query()->findOrFail($id);
        return view('category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = category::query()->findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return to_route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        try {
            $category->delete();
            if ($category->image) {
                $oldFilePath = str_replace('storage/', '', $category->image);
                if (Storage::exists($oldFilePath)) {
                    Storage::delete($oldFilePath);
                }
            }
            return redirect()->back()->with('msg', ['success' => true, 'message' => 'Category deleted successfully']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('msg', ['success' => false, 'message' => 'Thao tác không thành công']);
        }
    }

    public function deleted(){
        $category = Category::onlyTrashed()->get();
        return view('category.delete', compact('category'));
    }

    public function permanentlyDelete($id)
    {
        try {
            $category = Category::where('id', $id);
            $category->forceDelete();
            // if ($delete->image) {
            //     $oldFilePath = str_replace('storage/', '', $category->image);
            //     if (Storage::exists($oldFilePath)) {
            //         Storage::delete($oldFilePath);
            //     }
            // }
            return redirect()->back()->with('msg', ['success' => true, 'message' => 'Category deleted successfully']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('msg', ['success' => false, 'message' => 'Thao tác không thành công']);
        }
    }

    public function restore($id){
        $softDeletedCategory = Category::onlyTrashed()->find($id);
        $softDeletedCategory->restore();
        return redirect()->back();
    }
}
