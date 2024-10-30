<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meals List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Meals List</h1>
        <form method="GET" action="{{ route('meals.index') }}" class="filter-form" id="filter-form">
            <div class="filter-group">
                <label for="per_page">Items per page:</label>
                <select id="per_page" name="per_page" onchange="this.form.submit()">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </div>
            @php

                $withOptions = explode(',', request('with', ''));
                $selectedTags = explode(',', request('tags', ''));
                $selectedIngredients = explode(',', request('ingredients', ''));
                $selectedCategories = explode(',', request('category', ''));
            @endphp

            <div class="filter-group">
                <h2>With:</h2>
                <label><input type="checkbox" name="with" value="category" {{ in_array('category', $withOptions) ? 'checked' : '' }}>Categories</label>
                <label><input type="checkbox" name="with" value="tags" {{ in_array('tags', $withOptions) ? 'checked' : '' }}>Tags</label>
                <label><input type="checkbox" name="with" value="ingredients" {{ in_array('ingredients', $withOptions) ? 'checked' : '' }}>Ingredients</label>
            </div>

            <div class="filter-group">
                <h2>Tags</h2>
                @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags" value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                        {{ $tag->translations->first()->title }}
                    </label>
                @endforeach
            </div>

            <div class="filter-group">
                <h2>Ingredients</h2>
                @foreach($ingredients as $ingredient)
                    <label>
                        <input type="checkbox" name="ingredients" value="{{ $ingredient->id }}" {{ in_array($ingredient->id, $selectedIngredients) ? 'checked' : '' }}>
                        {{ $ingredient->translations->first()->title }}
                    </label>
                @endforeach
            </div>

            <div class="filter-group">
                <h2>Categories</h2>
                @foreach($categories as $category)
                    <label>
                        <input type="checkbox" name="category" value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                        {{ $category->translations->first()->title }}
                    </label>
                @endforeach
                <label>
                    <input type="checkbox" name="category" value="NULL" {{ in_array('NULL', $selectedCategories) ? 'checked' : '' }}>
                    No category
                </label>
                <label>
                    <input type="checkbox" name="category" value="!NULL" {{ in_array('!NULL', $selectedCategories) ? 'checked' : '' }}>
                    Any category
                </label>
            </div>

            <button type="submit" class="submit-btn">Apply Filters</button>
        </form>

        @if(empty($meals))
            <p class="no-meals">No meals found.</p>
        @else
            <div class="pagination">
                {{ $meals->appends(request()->except('page'))->links() }}
            </div>

            <table class="meal-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Ingredients</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meals as $meal)
                        <tr>
                            <td>{{ $meal['id'] }}</td>
                            <td>{{ $meal['title'] }}</td>
                            <td>{{ $meal['description'] }}</td>
                            <td>{{ $meal['status'] }}</td>
                            <td>{{ $meal['category']['title'] ?? '' }}</td>
                            <td>
                                @if(!empty($meal['tags']))
                                    <ul>
                                        @foreach($meal['tags'] as $tag)
                                            <li>{{ $tag['title'] }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                @endif
                            </td>
                            <td>
                                @if(!empty($meal['ingredients']))
                                    <ul>
                                        @foreach($meal['ingredients'] as $ingredient)
                                            <li>{{ $ingredient['title'] }}</li>
                                        @endforeach
                                    </ul>
                                @else

                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        $(document).ready(function () {
            $('#per_page').change(function () {
                updateUrl();
            });

            $('#filter-form').on('submit', function (e) {
                e.preventDefault();
                updateUrl();
            });

            function updateUrl() {
                let lang = "{{ request('lang', 'en') }}";
                let queryParams = {
                    lang: lang,
                    per_page: $('#per_page').val()
                };

                $('.filter-form input[type="checkbox"]:checked').each(function () {
                    let name = $(this).attr('name');
                    let value = $(this).val();
                    if (!queryParams[name]) {
                        queryParams[name] = [];
                    }

                    queryParams[name].push(value);
                });

                for (let key in queryParams) {
                    if (Array.isArray(queryParams[key])) {
                        queryParams[key] = queryParams[key].join(',');
                    }

                }

                let queryString = $.param(queryParams);
                let actionUrl = "{{ route('meals.index') }}" + '?' + queryString;

                window.location.href = actionUrl;
            }
        });
    </script>
</body>

</html>