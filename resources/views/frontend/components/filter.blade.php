    <style>
        .filter-section {
            background-color: var(--color-primary);
            padding: 20px;
            border-radius: 8px;
            margin: 20px;
        }

        .filter-title {
            color: var(--color-accent);
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--color-primary);
        }

        .filter-group {
            margin-bottom: 25px;
        }

        .filter-group-title {
            color: var(--color-dark);
            font-size: 1.1rem;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .filter-group-title::after {
            content: '+';
            font-size: 1.2rem;
            color: var(--color-secondary);
        }

        .filter-group-title.expanded::after {
            content: '-';
        }

        .filter-group-content {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-out;
        }

        .filter-group-content.show {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }

        /* Price Range Slider Styles */
        .price-slider-container {
            padding: 0 10px;
            margin-bottom: 20px;
        }

        .price-slider {
            position: relative;
            height: 4px;
            background-color: var(--color-primary);
            border-radius: 2px;
            width: 95%;
            margin: 20px 0;
        }

        .price-slider .track {
            position: absolute;
            height: 100%;
            background-color: var(--color-secondary);
            border-radius: 2px;
            z-index: 1;
        }

        .price-slider .thumb {
            position: absolute;
            width: 18px;
            height: 18px;
            background-color: var(--color-secondary);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            cursor: pointer;
        }

        .price-slider .thumb.min {
            left: 0;
        }

        .price-slider .thumb.max {
            left: 100%;
        }

        .price-inputs {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .price-input {
            width: 40%;
            padding: 8px 12px;
            border: 1px solid var(--color-primary);
            border-radius: 4px;
            font-size: 0.9rem;
            text-align: center;
        }

        .price-input:focus {
            outline: none;
            border-color: var(--color-secondary);
        }

        .price-values {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--color-dark);
            margin-top: 5px;
        }

        /* Other filter styles */
        .checkbox-option,
        .radio-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-option input,
        .radio-option input {
            margin-right: 10px;
            accent-color: var(--color-secondary);
        }

        .checkbox-option label,
        .radio-option label {
            color: var(--color-dark);
            font-size: 0.95rem;
            cursor: pointer;
        }

        .color-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .color-option {
            position: relative;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
        }

        .color-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .color-option .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .color-option input:checked~.checkmark {
            border-color: var(--color-dark);
            box-shadow: 0 0 0 2px var(--color-secondary);
        }

        .color-option .checkmark::after {
            content: '';
            position: absolute;
            display: none;
            left: 10px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .color-option input:checked~.checkmark::after {
            display: block;
        }

        .size-options {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .size-option {
            position: relative;
            border: 0.5px solid var(--color-secondary);
            border-radius: 5px;
        }

        .size-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .size-option label {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid var(--color-primary);
            border-radius: 4px;
            min-width: 40px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .size-option input:checked~label {
            background-color: var(--color-secondary);
            color: var(--color-light);
            border-color: var(--color-secondary);
        }

        /* Button styles */
        .filter-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .apply-filters,
        .clear-filters {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .apply-filters {
            background-color: var(--color-secondary);
            color: var(--color-light);
            font-weight: bold;
        }

        .apply-filters:hover {
            background-color: var(--color-accent);
            color: var(--color-tertiary);
        }

        .clear-filters {
            background-color: var(--color-primary);
            color: var(--color-dark);
            font-weight: bold;
            border: 1px solid var(--color-secondary);
        }

        .clear-filters:hover {
            background-color: var(--color-accent);
            border-color: var(--color-accent);
            color: var(--color-tertiary)
        }

        @media (max-width: 768px) {
            .filter-section {
                max-width: 100%;
                margin: 10px 0;
            }
        }
    </style>
    <div class="filter-section">
        <h2 class="filter-title">Filters</h2>

        <!-- Price Range Filter -->
        <div class="filter-group">
            <h3 class="filter-group-title">Price Range</h3>
            <div class="filter-group-content show">
                <div class="price-slider-container">
                    <div class="price-slider">
                        <div class="track"></div>
                        <div class="thumb min"></div>
                        <div class="thumb max"></div>
                    </div>
                    <div class="price-values">
                        <span>$0</span>
                        <span>$10000</span>
                    </div>
                    <div class="price-inputs">
                        <input type="number" class="price-input" id="minPrice" placeholder="Min" min="0"
                            max="10000" value="0">
                        <input type="number" class="price-input" id="maxPrice" placeholder="Max" min="0"
                            max="10000" value="10000">
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="filter-group">
            <h3 class="filter-group-title">Category</h3>
            <div class="filter-group-content">
                <div class="checkbox-option">
                    <input type="checkbox" id="category1" name="category">
                    <label for="category1">Furniture</label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" id="category2" name="category">
                    <label for="category2">Lighting</label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" id="category3" name="category">
                    <label for="category3">Decor</label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" id="category4" name="category">
                    <label for="category4">Textiles</label>
                </div>
            </div>
        </div>

        <!-- Color Filter -->
        <div class="filter-group">
            <h3 class="filter-group-title">Color</h3>
            <div class="filter-group-content">
                <div class="color-options">
                    <div class="color-option">
                        <input type="radio" id="color1" name="color">
                        <span class="checkmark" style="background-color: #415E72;"></span>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color2" name="color">
                        <span class="checkmark" style="background-color: #ac8e51;"></span>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color3" name="color">
                        <span class="checkmark" style="background-color: #FFA673;"></span>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color4" name="color">
                        <span class="checkmark" style="background-color: #222222;"></span>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color5" name="color">
                        <span class="checkmark" style="background-color: #F5F5F5; border: 1px solid #ddd;"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Size Filter -->
        <div class="filter-group">
            <h3 class="filter-group-title">Size</h3>
            <div class="filter-group-content">
                <div class="size-options">
                    <div class="size-option">
                        <input type="radio" id="size1" name="size">
                        <label for="size1">S</label>
                    </div>
                    <div class="size-option">
                        <input type="radio" id="size2" name="size">
                        <label for="size2">M</label>
                    </div>
                    <div class="size-option">
                        <input type="radio" id="size3" name="size">
                        <label for="size3">L</label>
                    </div>
                    <div class="size-option">
                        <input type="radio" id="size4" name="size">
                        <label for="size4">XL</label>
                    </div>
                    <div class="size-option">
                        <input type="radio" id="size5" name="size">
                        <label for="size5">XXL</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-buttons">
            <button class="apply-filters">Apply</button>
            <button class="clear-filters">Clear</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Collapsible sections
            const filterTitles = document.querySelectorAll('.filter-group-title');

            filterTitles.forEach(title => {
                title.addEventListener('click', function() {
                    this.classList.toggle('expanded');
                    const content = this.nextElementSibling;
                    content.classList.toggle('show');
                });
            });

            // Price Range Slider
            const priceSlider = document.querySelector('.price-slider');
            const track = document.querySelector('.track');
            const minThumb = document.querySelector('.thumb.min');
            const maxThumb = document.querySelector('.thumb.max');
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');
            const minValue = 0;
            const maxValue = 10000;
            let minPrice = 0;
            let maxPrice = 10000;

            // Initialize slider
            function initSlider() {
                updateSlider();

                minThumb.addEventListener('mousedown', startDrag);
                minThumb.addEventListener('touchstart', startDrag);
                maxThumb.addEventListener('mousedown', startDrag);
                maxThumb.addEventListener('touchstart', startDrag);

                minPriceInput.addEventListener('input', updateFromInput);
                maxPriceInput.addEventListener('input', updateFromInput);
            }

            function startDrag(e) {
                e.preventDefault();
                const thumb = e.target;
                const isMin = thumb.classList.contains('min');

                document.addEventListener('mousemove', handleDrag);
                document.addEventListener('touchmove', handleDrag);
                document.addEventListener('mouseup', stopDrag);
                document.addEventListener('touchend', stopDrag);

                function handleDrag(e) {
                    const clientX = e.clientX || e.touches[0].clientX;
                    const rect = priceSlider.getBoundingClientRect();
                    let percentage = (clientX - rect.left) / rect.width;
                    percentage = Math.max(0, Math.min(1, percentage));

                    if (isMin) {
                        minPrice = Math.round(minValue + percentage * (maxValue - minValue));
                        if (minPrice >= maxPrice) minPrice = maxPrice - 1;
                    } else {
                        maxPrice = Math.round(minValue + percentage * (maxValue - minValue));
                        if (maxPrice <= minPrice) maxPrice = minPrice + 1;
                    }

                    updateSlider();
                }

                function stopDrag() {
                    document.removeEventListener('mousemove', handleDrag);
                    document.removeEventListener('touchmove', handleDrag);
                    document.removeEventListener('mouseup', stopDrag);
                    document.removeEventListener('touchend', stopDrag);
                }
            }

            function updateFromInput() {
                minPrice = parseInt(minPriceInput.value) || 0;
                maxPrice = parseInt(maxPriceInput.value) || 10000;

                if (minPrice < minValue) minPrice = minValue;
                if (maxPrice > maxValue) maxPrice = maxValue;
                if (minPrice >= maxPrice) minPrice = maxPrice - 1;

                updateSlider();
            }

            function updateSlider() {
                const minPercentage = (minPrice - minValue) / (maxValue - minValue);
                const maxPercentage = (maxPrice - minValue) / (maxValue - minValue);

                minThumb.style.left = `${minPercentage * 100}%`;
                maxThumb.style.left = `${maxPercentage * 100}%`;
                track.style.left = `${minPercentage * 100}%`;
                track.style.width = `${(maxPercentage - minPercentage) * 100}%`;

                minPriceInput.value = minPrice;
                maxPriceInput.value = maxPrice;
            }

            // Clear Filters Functionality
            const clearButton = document.querySelector('.clear-filters');
            clearButton.addEventListener('click', function() {
                // Reset price range
                minPrice = minValue;
                maxPrice = maxValue;
                updateSlider();

                // Uncheck all category checkboxes
                document.querySelectorAll('input[name="category"]').forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Unselect color
                document.querySelectorAll('input[name="color"]').forEach(radio => {
                    radio.checked = false;
                });

                // Unselect size
                document.querySelectorAll('input[name="size"]').forEach(radio => {
                    radio.checked = false;
                });
            });

            // Apply Filters Functionality (would connect to your actual filtering logic)
            const applyButton = document.querySelector('.apply-filters');
            applyButton.addEventListener('click', function() {
                // Here you would implement your actual filtering logic
                const filters = {
                    minPrice: minPrice,
                    maxPrice: maxPrice,
                    categories: Array.from(document.querySelectorAll('input[name="category"]:checked'))
                        .map(el => el.id),
                    color: document.querySelector('input[name="color"]:checked')?.id,
                    size: document.querySelector('input[name="size"]:checked')?.id
                };

                console.log('Applying filters:', filters);
                alert('Filters applied! Check console for details.');
            });

            initSlider();
        });
    </script>
