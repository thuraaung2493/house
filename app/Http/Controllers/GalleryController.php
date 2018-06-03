<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('homes.gallery');
    }

    public function loadData($number)
    {
        $galleries = Gallery::join('houses', 'galleries.house_id', '=', 'houses.id')->where('is_featured', 1)->where('is_approved', 1)->orderBy('galleries.created_at', 'desc')->limit($number)->get();

        $count = Gallery::join('houses', 'galleries.house_id', '=', 'houses.id')->where('is_featured', 1)->where('is_approved', 1)->orderBy('galleries.created_at', 'desc')->limit($number)->count();

        // dd($galleries);
        $path = asset('/storage/photos/');

        return response()->json([
            'galleries' => $galleries,
            'path' => $path,
            'count' => $count,
        ], 200);
    }

}
