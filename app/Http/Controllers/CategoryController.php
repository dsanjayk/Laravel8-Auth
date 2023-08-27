<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('backend.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
         // $this->validate( $request, [
        //     'name' => 'string|required',
        //     'description' => 'string|nullable',
        //     'is_parent' => 'sometimes|in:1',
        //     'parent_id' => 'nullable|in:active,inactive',
        // ]);

        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $data['is_parent'] = $request->input('is_parent');
        $data['is_parent'] = ( isset( $data['is_parent'] ) && $data['is_parent'] == 1 ) ? 1 : 0;
        $data['parent_id'] = $request->input('parent_id');
        if( $data['is_parent'] == 1 ){
            $data['parent_id'] = NULL;
        }

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();
        if( $slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;

        $response = Category::create($data);
        
        if($response){
            return redirect()->route('categories.index')->with('success', 'Category added successfully');
        }else{
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit(Category $category)
    {
        $category = Category::where('id',$category->id)->first();
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('backend.categories.edit', compact('category','categories'));
    }

    public function update(Request $request, string $id)
    { 
        // $this->validate( $request, [
        //     'name' => 'string|required',
        //     'description' => 'string|nullable',
        //     'is_parent' => 'sometimes|in:1',
        //     'parent_id' => 'nullable|in:active,inactive',
        // ]);

        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $data['is_parent'] = $request->input('is_parent');
        $data['is_parent'] = ( isset( $data['is_parent'] ) && $data['is_parent'] == 1 ) ? 1 : 0;
        $data['parent_id'] = $request->input('parent_id');
        if( $data['is_parent'] == 1 ){
            $data['parent_id'] = NULL;
        }

        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();
        if( $slug_count > 0){
            $slug = time().$slug;
        }
        $data['slug'] = $slug;
        $response = Category::where('id',$id)->update($data);
        
        if($response){
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        }else{
            return back()->with('error', 'Something went wrong!');
        }
        
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
