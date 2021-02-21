@section('web-title', $book->name )
@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0">
        <section class="resume-section">
            <div class="resume-section-content">
                <div class="book-detial">
                    <div class="row">
                        <div class="col-12 col-sm-3 col-md-2 col-lg-2">
                            <img src="{{ Storage::disk('admin')->url($book->cover) }}" alt="">
                        </div>
                        <div class="col-12 col-sm-9 col-md-10 col-lg-10">
                            <h2>{{ $book->name }}</h2>
                            <h5>書號: {{ $book->sid }}</h5>
                            <h5>ISBN: {{ $book->isbn }}</h5>
                            <h5>出版社: {{ $book->publisher->name }}</h5>
                            <h5>發售年: {{ $book->publish_year }}</h5>
                            <h5>科目: {{ $book->subject->name }}</h5>
                            <h5>描述:</h5>
                            <p>{{ $book->describe }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">分類選擇</label>
                        <select class="form-control" id="file-type" data-book_id="{{ $book->id }}">
                            <option value="all" selected>全部檔案</option>
                            @foreach ($catalogs as $catalog)
                                <option value="{{ $catalog->id }}" @if ($request->catalog == $catalog->id) {{'selected'}} @endif>{{ $catalog->name }}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <div class="divide-line"></div>
                <div class="table-responsive file-list">
                    <table class="table">
                        <caption>尊重著作財產權，請勿隨意外流!</caption>
                        <thead>
                            <tr style="background-color: #e9ecef">
                            <th scope="col"><input type="checkbox" class="select-all"></th>
                            <th scope="col">下載</th>
                            <th scope="col">檔名</th>
                            <th scope="col">分類</th>
                            <th scope="col">預覽</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book->files as $file)
                                @foreach ($file->path as $pfile)
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox" name="selectfiles[]" value="{{ basename($pfile) }}" class="select-item">
                                        </th>
                                        <td><a target="_blank" href="{{ Storage::disk('admin')->url($pfile) }}"><i class="fas fa-download fa-fw"></i></a></td>
                                        <td><a target="_blank" href="{{ Storage::disk('admin')->url($pfile) }}">{{ basename($pfile) }}</a></td>
                                        <td>{{ $file->catalog->name }}</td>
                                        <td><button class="btn btn-light view-online" data-url="{{ Storage::disk('admin')->url($pfile) }}"><i class="far fa-eye fa-fw"></i></button></td>
                                    </tr>
                                @endforeach  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    
    <div class="modal fade" id="pdf-view">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdf-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="pdf-container">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


@endsection