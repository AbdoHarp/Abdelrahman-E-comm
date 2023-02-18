<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\product;
use App\Models\Product_Image;
use App\Models\ProductColor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = product::all();
        return view('admin/product/index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status', '0')->get();
        return view('admin/product/create', compact('categories', 'brands', 'colors'));
    }
    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['categroy_id']);

        $product =  $category->products()->create([
            'categroy_id' => $validatedData['categroy_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'featured' => $request->featured == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }
        return redirect('/admin/product')->with('message', 'Product Added Successfully');

        // return $product->id;


        // $validatedData = $request->validated();
        // $product = new product;
        // $product->categroy_id = $validatedData['categroy_id'];
        // $product->name = $validatedData['name'];
        // $product->slug = Str::slug($validatedData['slug']);
        // $product->brand = $validatedData['brand'];
        // $product->small_description = $validatedData['small_description'];
        // $product->description = $validatedData['description'];
        // $product->original_price = $validatedData['original_price'];
        // $product->selling_price = $validatedData['selling_price'];
        // $product->quantity = $validatedData['quantity'];
        // $product->trending = $request->trending == true ? '1' : '0';
        // $product->status = $request->status == true ? '1' : '0';
        // $product->meta_title = $validatedData['meta_title'];
        // $product->meta_keyword = $validatedData['meta_keyword'];
        // $product->meta_description = $validatedData['meta_description'];
        // $product->save();
        // return redirect('admin/product')->with('message', 'product Added successfully');

    }

    public function edit(int $product_id)
    {
        $product = product::findOrFail($product_id);
        $categories = Category::all();
        $brands = Brand::all();
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id', $product_color)->get();
        return view('admin/product/edit', compact('product', 'categories', 'brands', 'colors'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['categroy_id'])
            ->products()->where('id', $product_id)->first();

        if ($product) {
            $product->update([
                'categroy_id' => $validatedData['categroy_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1' : '0',
                'featured' => $request->featured == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/products/';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extention;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
            if ($request->colors) {
                foreach ($request->colors as $key => $color) {
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->colorquantity[$key] ?? 0
                    ]);
                }
            }
            return redirect('/admin/product')->with('message', 'Product Updated Successfully');
        } else {
            return redirect('/admin/product')->with('message', 'No such Product Id Found');
        }
    }

    public function destroyImage(int $product_image_id)
    {
        $productImage = Product_Image::findOrFail($product_image_id);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Porduct Image Delete Successfully');
    }

    public function destroy(int $product_id)
    {
        $product = product::findOrFail($product_id);
        if ($product->productImages) {
            foreach ($product->productImages() as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect('/admin/product')->with('message', 'Porduct Deleted With all images Successfully');
    }

    public function updateProdColorQty(Request $request, $prod_color_id)
    {
        $productColorData = product::findOrFail($request->product_id)->productColors()->where('id', $prod_color_id)->first();
        $productColorData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message' => 'Product Color Qty Updated']);
    }
    public function destroyProdColor($prod_color_id)
    {
        $productColor = ProductColor::findOrFail($prod_color_id);
        $productColor->delete();
        return response()->json(['message' => 'Product Color Deleted']);
    }
}
