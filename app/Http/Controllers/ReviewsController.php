<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Review;
use DB;

class ReviewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$reviews = Review::all();
        //return Review::where('title', 'Review Two')->get();
        //$reviews = DB::select('SELECT * FROM reviews');
        //$reviews = Review::orderBy('title','desc')->take(1)->get();
        //$reviews = review::orderBy('title','desc')->get();

        $reviews = review::orderBy('created_at','desc')->paginate(10);
        return view('reviews.index')->with('reviews', $reviews);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'artist' => 'required',
            'summary' => 'required',
            'category' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Review
        $review = new Review;
        $review->category = $request->input('category');
        $review->title = $request->input('title');
        $review->artist = $request->input('artist');
        $review->label = $request->input('label');
        $review->summary = $request->input('summary');
        $review->body = $request->input('body');
        $review->web1 = $request->input('web1');
        $review->web2 = $request->input('web2');
        $review->web3 = $request->input('web3');
        $review->user_id = auth()->user()->id;
        $review->cover_image = $fileNameToStore;
        $review->save();

        return redirect('/reviews')->with('success', 'Review Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);
        return view('reviews.show')->with('review', $review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);

        // Check for correct user
        if(auth()->user()->id !==$review->user_id){
            return redirect('/reviews')->with('error', 'Unauthorized Page');
        }

        return view('reviews.edit')->with('review', $review);
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
        $this->validate($request, [
            'title' => 'required',
            'artist' => 'required',
            'summary' => 'required',
            'category' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

         // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Create Review
        $review = Review::find($id);
        $review->category = $request->input('category');
        $review->title = $request->input('title');
        $review->artist = $request->input('artist');
        $review->label = $request->input('label');
        $review->summary = $request->input('summary');
        $review->body = $request->input('body');
        $review->web1 = $request->input('web1');
        $review->web2 = $request->input('web2');
        $review->web3 = $request->input('web3');
        if($request->hasFile('cover_image')){
            $review->cover_image = $fileNameToStore;
        }
        $review->save();

        return redirect('/reviews')->with('success', 'Review Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);

        // Check for correct user
        if(auth()->user()->id !==$review->user_id){
            return redirect('/reviews')->with('error', 'Unauthorized Page');
        }

        if($review->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$review->cover_image);
        }
        
        $review->delete();
        return redirect('/reviews')->with('success', 'Review Removed');
    }
}