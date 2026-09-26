
<div class="accordion-item">

    <h2 class="accordion-header">
        <button class="accordion-button"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseTwo">
            Brand
        </button>
    </h2>

    <div id="panelsStayOpen-collapseTwo"
        class="accordion-collapse collapse show">

        <div class="accordion-body">

            <form method="GET" action="{{ route('shop') }}">

                <ul class="collection-listing">

                    @forelse($brands as $brand)

                        <li>
                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="brand[]"
                                    value="{{ $brand }}"
                                    id="brand-{{ Str::slug($brand) }}"
                                    {{ in_array($brand, $selectedBrands ?? []) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label"
                                    for="brand-{{ Str::slug($brand) }}">
                                    {{ $brand }}
                                </label>

                            </div>
                        </li>

                    @empty

                        <li>
                            No brands available.
                        </li>

                    @endforelse

                </ul>

                <button type="submit" class="btn btn-solid mt-2">
                    Apply Filter
                </button>

                @if (!empty($selectedBrands))
                    <a href="{{ route('shop') }}" class="btn btn-outline-secondary mt-2">
                        Clear
                    </a>
                @endif

            </form>

        </div>
    </div>

</div>
