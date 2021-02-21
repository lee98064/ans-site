<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Catalog;
use App\Models\File;
use Illuminate\Http\Request;
use App\Models\Publisher;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::with(['books' => function($q){
            $q->where('released','=', true);
        }])->get();
        return view('book.index',['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $book = Book::with(['files' => function($q) use ($request){
            if ($request->catalog && $request->catalog != "all"){
                $q->where('catalog_id','=', $request->catalog);
            }
        },'subject','publisher'])->findOrFail($id);

        $files = File::where('book_id', '=', $book->id)->get();
        $catalog_id = [];
        foreach ($files as $file) {
            array_push($catalog_id, $file->catalog_id);
        }
        $catalogs = Catalog::whereIn('id',$catalog_id)->get();
        return view('book.show',['book' => $book,'catalogs' => $catalogs,'request' => $request]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
