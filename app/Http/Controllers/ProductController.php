<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Str;

class ProductController extends Controller
{
    function product()
    {
        $categories = Category::all();
        return view('backend.product.product', [
            'categories' => $categories,
        ]);
    }


    function product_store(Request $request)
    {

        $request->validate([
            'product_name'      => 'required',
            'price'             => 'required|integer',
            'category_id'       => 'required|integer',
            'quantity'          => 'required',
            'long_desp'         => 'required',
            'preview'           => 'required|file|mimes:jpg,png|max:5000',

        ]);

        $slug = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(999999, 10000000) . '-ayan';

        $after_discount = $request->price - ($request->price * $request->discount) / 100;


        $uploaded_file = $request->preview;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . '.' . $extension;
        Image::make($uploaded_file)->save(public_path('/uploads/product/' . $file_name));

        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity'    => $request->quantity,
            'discount' => $request->discount,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'slug' => $slug,
            'preview' => $file_name,
            'after_discount' => $after_discount,
            'created_at' => Carbon::now(),
        ]);


        return back()->with('product', 'Product added successfully');
    }


    function product_list()
    {
        $products = Product::all();
        return view('backend.product.product_list', [
            'products' => $products,
        ]);
    }

    function product_edit($product_id)
    {
        $product = Product::find($product_id);
        $categories = Category::all();

        return view('backend.product.product_edit', [
            'product'       => $product,
            'categories'    => $categories,
        ]);
    }


    function product_update(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'long_desp' => 'required',
            'quantity'  => 'required'
        ]);

        $slug = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(999999, 10000000) . '-ayan';

        $after_discount = $request->price - ($request->price * $request->discount) / 100;

        // if image is null
        if ($request->preview == '') {
            Product::find($request->product_id)->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'quantity'      => $request->quantity,
                'discount' => $request->discount,
                'short_desp' => $request->short_desp,
                'long_desp' => $request->long_desp,
                'slug' => $slug,
                'after_discount' => $after_discount,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('product_update', 'Product updated successfully');
        }

        // image is not null
        else {
            // delete previous image from public folder
            $image = Product::find($request->product_id)->preview;
            $deleted_from = public_path('/uploads/product/' . $image);
            unlink($deleted_from);

            // setup new image
            $uploaded_file = $request->preview;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('/uploads/product/' . $file_name));

            Product::find($request->product_id)->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'quantity'      => $request->quantity,
                'discount' => $request->discount,
                'short_desp' => $request->short_desp,
                'long_desp' => $request->long_desp,
                'slug' => $slug,
                'preview' => $file_name,
                'after_discount' => $after_discount,
                'created_at' => Carbon::now(),
            ]);


            return back()->with('product_update', 'Product updated successfully');
        }
    }

    function product_delete($product_id)
    {
        $product_img = Product::find($product_id)->preview;
        $deleted_from = public_path('/uploads/product/' . $product_img);
        unlink($deleted_from);

        Product::find($product_id)->delete();

        return back()->with('product_delete', 'Product has been deleted');
    }


    public function changeStatus(Request $request)
    {
        $product = Product::find($request->id);
        $product->listed = $request->listed;
        $product->save();

        return response()->json(['success' => 'Product Listed successfully.']);
    }
}
