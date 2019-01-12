@extends('index')

@section('head')
@parent
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
@endsection

@section('title',$product->title)

    @section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-6 img">
                <img src="{{$product->image}}" alt="" class="img-rounded">
            </div>
            <div class="col-md-6 details">
                <blockquote>
                    <h5>{{$product->title}}</h5>
                    <small>{{$product->currency}} : {{number_format($product->ammount)}}</small>
                </blockquote>
                <p>
                    {{$product->description}}
                </p>
            </div>

            <div class="col-md-12 comment">
                <h5>Comments Product</h5>
                @isset($vote)
                @foreach ($vote as $element)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <strong>Comment Number {{$element->id}}</strong>
                                    <span class="float-right">Score : {{$element->score}}</span>
                                </p>
                                <div class="clearfix"></div>
                                <p>{{$element->comment}}
                                    <p>
                                        <form method="POST" action="/vote/{{$product->url_id}}">
                                            @csrf
                                            <input type="hidden" name="up" value="1">
                                            <button type="submit" class="float-right btn btn-outline-primary ml-2"> <i class="far fa-thumbs-up"></i> {{$element->up}}</button>
                                        </form>
                                        <form method="POST" action="/vote/{{$product->url_id}}">
                                            @csrf
                                            <input type="hidden" name="down" value="1">
                                            <button type="submit" class="float-right btn text-white btn-danger"> <i class="far fa-thumbs-down"></i> {{$element->down}}</button>
                                        </form>
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $vote->links() }}
                @endisset
            </div>
            <div class="col-md-12 leave">
                <form method="POST" action="/comment/{{$product->url_id}}">
                    @csrf
                    <div class="form-group">
                        <label for="commentbox">Leave a comment</label>
                        <textarea name="comment" class="form-control" id="commentbox" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Comment</button>
                </form>
            </div>
        </div>
    </div>

    @endsection
