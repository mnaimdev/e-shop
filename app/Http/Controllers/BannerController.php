<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Image;

class BannerController extends Controller
{
    function banner()
    {
        return view('backend.banner.banner');
    }


    function banner_store(Request $request)
    {

        $request->validate([
            'title'                 => 'required',
            'color'                 => 'required',
            'heading'               => 'required',
            'link'                  => 'required|url',
            'banner_type'           => 'required',
            'image'                 => 'required|file|mimes:jpg,png|max:5000',

        ]);

        $uploaded_file = $request->image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->title)) . '.' . $extension;
        Image::make($uploaded_file)->save(public_path('/uploads/banner/' . $file_name));

        Banner::create([
            'title'                 => $request->title,
            'color'                 => $request->color,
            'heading'               => $request->heading,
            'link'                  => $request->link,
            'banner_type'           => $request->banner_type,
            'image'                 => $file_name,
            'created_at'            => Carbon::now(),
        ]);


        return back()->with('banner', 'Banner added successfully');
    }


    function banner_list()
    {
        $banners = Banner::all();
        return view('backend.banner.banner_list', [
            'banners' => $banners,
        ]);
    }

    function banner_edit($product_id)
    {
        $banner = Banner::find($product_id);

        return view('backend.banner.banner_edit', [
            'banner'       => $banner,
        ]);
    }


    function banner_update(Request $request)
    {

        $request->validate([
            'title'                 => 'required',
            'color'                 => 'required',
            'heading'               => 'required',
            'link'                  => 'required|url',
            'banner_type'           => 'required',
            'image'                 => 'file|mimes:jpg,png|max:5000',

        ]);

        if ($request->image !== null) {
            $image = Banner::find($request->id)->image;
            $deleted_from = public_path('/uploads/banner/' . $image);
            unlink($deleted_from);


            $uploaded_file = $request->image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->title)) . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('/uploads/banner/' . $file_name));



            Banner::find($request->id)->update([
                'title'                 => $request->title,
                'color'                 => $request->color,
                'heading'               => $request->heading,
                'link'                  => $request->link,
                'banner_type'           => $request->banner_type,
                'image'                 => $file_name,
                'created_at'            => Carbon::now(),
            ]);
        } else {

            Banner::find($request->id)->update([
                'title'                 => $request->title,
                'color'                 => $request->color,
                'heading'               => $request->heading,
                'link'                  => $request->link,
                'banner_type'           => $request->banner_type,
                'created_at'            => Carbon::now(),
            ]);
        }


        return back()->with('banner_update', 'Banner updated successfully');
    }

    function banner_delete($banner_id)
    {
        $banner_img = Banner::find($banner_id)->image;
        $deleted_from = public_path('/uploads/banner/' . $banner_img);
        unlink($deleted_from);

        Banner::find($banner_id)->delete();

        return back()->with('banner_delete', 'Banner has been deleted');
    }
}
