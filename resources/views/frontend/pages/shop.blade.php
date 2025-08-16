@extends('frontend.layouts.app')
@section('css')
    <style>
        .sort-dropdown {
            position: relative;
            width: 200px;
        }

        .sort-dropdown select {
            width: 100%;
            padding: 10px 15px;
            font-size: 14px;
            color: var(--color-dark);
            background-color: var(--color-light);
            border: 1px solid var(--color-accent);
            border-radius: 4px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sort-dropdown select:focus {
            outline: none;
            border-color: var(--color-secondary);
        }

        .sort-dropdown::after {
            content: "▼";
            font-size: 12px;
            color: var(--color-accent);
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .sort-dropdown select option {
            padding: 10px;
            background-color: var(--color-primary);
            /* Light background */
            color: var(--color-accent);
            /* Accent color for text */
        }

        .sort-dropdown select option:hover {
            background-color: var(--color-accent);
            /* Accent background on hover */
            color: var(--color-tertiary);
            /* Tertiary color for text on hover */
        }

        /* For Firefox */
        @-moz-document url-prefix() {
            .sort-dropdown select option {
                background-color: var(--color-light);
            }

            .sort-dropdown select option:checked,
            .sort-dropdown select option:hover {
                background-color: var(--color-accent);
                color: var(--color-tertiary);
            }
        }

        /* For IE10+ */
        @media screen and (-ms-high-contrast: active),
        (-ms-high-contrast: none) {
            .sort-dropdown select option {
                background-color: var(--color-light);
            }

            .sort-dropdown select option:checked,
            .sort-dropdown select option:hover {
                background-color: var(--color-accent);
                color: var(--color-tertiary);
            }
        }
    </style>
@endsection

@section('content')
    <section class="container mb-5">
        <div class="row my-3">
            <div class="col-md-3" style="margin-top: 35px;">
                @include('frontend.components.filter', ['categories' => $categories])
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center p-2">
                    <div></div>
                    <div class="sort-dropdown">
                        <select name="sort" id="sort">
                            <option value="">Sort by</option>
                            <option value="newest">Date: Newest</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                        </select>
                    </div>
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
