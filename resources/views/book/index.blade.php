@section('web-title','所有書籍')
@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0">
        <section class="resume-section">
            <div class="resume-section-content">
                @foreach ($publishers as $publisher)
                    <div class="book-area">
                        <h1>{{ $publisher->name }}</h1>
                        <div class="row">
                            @foreach ($publisher->books as $book)
                                <div class="col-6 col-sm-6 col-md-3 col-lg-2">
                                    <div class="book shadow-sm" onclick="location.href='{{ route('books.show',$book) }}'">
                                        <img src="{{ Storage::disk('admin')->url($book->cover) }}" alt="" class="img-box img-responsive img-fluid">
                                        <h4>{{ $book->name }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection