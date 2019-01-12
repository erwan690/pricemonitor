@extends('index')
@section('title','List Product')
@section('main')
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            @isset($products)
            @foreach ($products as $element)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="{{$element->image}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-title">
                            <h5>{{$element->title}}</h5>
                        </p>
                        <p class="card-text">{{$element->currency.' : '.number_format($element->ammount)}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{'/product/'.$element->url_id}}" class="btn btn-sm btn-outline-secondary">View</a>
                            </div>
                            <small class="text-muted">{{$element->updated_at}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $products->links() }}
            @endisset
        </div>
    </div>
</div>

@endsection
