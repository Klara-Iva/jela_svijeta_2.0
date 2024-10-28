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

        <table>
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
                @foreach ($meals as $meal)
                    <tr>
                        <td>{{ $meal->id }}</td>
                        <td>{{ $meal->translations->first()->title ?? 'N/A' }}</td>
                        <td>{{ $meal->translations->first()->description ?? 'N/A' }}</td>
                        <td>{{ $meal->status }}</td>
                        <td>
                            @if($meal->category && $meal->category->translations->isNotEmpty())
                                {{ $meal->category->translations->first()->title }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($meal->tags->isEmpty())
                                N/A
                            @else
                                @foreach ($meal->tags as $tag)
                                    {{ $tag->translations->first()->title ?? 'N/A' }}@if(!$loop->last), @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($meal->ingredients->isEmpty())
                                N/A
                            @else
                                @foreach ($meal->ingredients as $ingredient)
                                    {{ $ingredient->translations->first()->title ?? 'N/A' }}@if(!$loop->last), @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
