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
        /* content: "▼"; */
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
<form action="{{ route('shop') }}" method="GET">
    <div class="sort-dropdown">
        <div class="dropdown">
            <button class="btn btn-transparent dropdown-toggle border-1 border-secondary" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Sort By
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="?sort=newest">Date: Newest</a>
                </li>
                <li>
                    <a class="dropdown-item" href="?sort=price_asc">Price: Low to High</a>
                </li>
                <li>
                    <a class="dropdown-item" href="?sort=price_desc">Price: High to Low</a>
                </li>
            </ul>
        </div>


        {{-- <select name="sort" id="sort">
            <option value="" selected >Sort by</option>
            <option value="newest" {{ request('short') == 'newest' ? 'selected' : '' }}>Date: Newest</option>
            <option value="name" {{ request('short') == 'name' ? 'selected' : '' }}>Name A to Z</option>
            <option value="price-low" {{ request('short') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price-high" {{ request('short') == 'price_high' ? 'selected' : '' }}>Price: High to Low
            </option>
            <option value="popular" {{ request('short') == 'popular' ? 'selected' : '' }}> Popular</option>
        </select> --}}
    </div>
</form>
