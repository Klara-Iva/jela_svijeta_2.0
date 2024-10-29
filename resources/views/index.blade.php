<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meals List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container">
        <h1>Meals List</h1>

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
                                    N/A
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
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>