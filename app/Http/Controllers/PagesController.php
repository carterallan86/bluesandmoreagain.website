<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\Input;


class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome To Laravel!';
        //return view('pages.index', compact('title'));
        //$reviews = review::orderBy('created_at')->get(3);
        $reviews = Review::orderBy('created_at','desc')->take(6)->get();
        return view('pages.index')->with('title', $title)->with('reviews', $reviews);
    }

    public function contact(){
        $title = 'Contact Us';
        return view('pages.contact')->with('title', $title);
    }
}
