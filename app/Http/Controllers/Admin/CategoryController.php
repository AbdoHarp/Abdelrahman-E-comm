<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaregoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin/category/index');
    }
    //create category page
    public function create()
    {
        return view('admin/category/create');
    }
    // Add category
    public function store(CaregoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadpath = 'uploads/category/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadpath . $filename;
        }
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1' : '0';
        $category->save();
        return redirect('admin/category')->with('message', 'category Added successfully');
    }

    // Edit category page
    public function edit(Category $cate_item)
    {
        // $category = Category::find($category);
        // return $cate_item;
        return view('admin/category/edit', compact('cate_item'));
    }
    public function update(CaregoryFormRequest $request, $category_id)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($category_id);
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];
        if ($request->hasFile('image')) {


            // update image
            $uploadpath = 'uploads/category/';
            $destination = 'uploads/category/' . $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadpath . $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1' : '0';
        $category->update();
        return redirect('admin/category')->with('message', 'category Updated successfully');
    }
    // public function destroyCategory(Category  $category_id)
    // {
    //     $category_id->delete();
    //     return redirect('admin/category')->with('message', 'Category Deleted Successfully ');
    // }
}
