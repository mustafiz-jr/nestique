@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
    <section class="container mb-5">
        <div class="row my-3">
            <div class="col-md-3" style="margin-top: 35px;">
                @include('frontend.components.filter', ['categories' => $categories, 'brands' => $brands])
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center p-2">
                    <div></div>
                    @include('frontend.components.short_form')
                </div>
                <div class="d-flex g-4 gap-4 justify-content-center flex-wrap flex-1">
                    @foreach ($products->take(12) as $product)
                        @include('frontend.components.product', ['product' => $product])
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
