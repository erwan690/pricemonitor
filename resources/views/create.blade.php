@extends('index')
@section('title','Add Product')
@section('main')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Add Url Here</h1>
        <p>
            <form method="POST" action="/product">
                @csrf
                <div class="input-group mb-3">
                    <input name="url" type="url" required class="form-control" placeholder="Please Insert Url Product on febelio.com Here" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </p>
    </div>
</section>

@endsection
