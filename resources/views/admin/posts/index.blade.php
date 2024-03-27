@extends('layouts.dashboard')

@section('posts')
    <div class="container">
        <h1 class="text-center mt-3">Admin panel</h1>
        <div class="mb-2 d-flex justify-content-between">
            <div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Фильтр
                    </button>
                    <div class="dropdown-menu px-4" aria-labelledby="filterDropdown">
                        <form class="px-4 py-2" action="{{ route('admin.dashboard.posts.filter') }}" method="GET" >
                            <div class="form-group">
                                <label for="statusFilter">По статусу</label>
                                <select class="form-control " id="statusFilter" name="status">
                                    <option value="">Выберите статус</option>
                                    <option value="New">New</option>
                                    <option value="Processed">Processed</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                            <button type="submit" class="form-control btn btn-outline-primary btn-sm">Применить</button>
                        </form>

                        <div class="dropdown-divider"></div>
                        <form class="px-4 py-2" action="{{ route('admin.dashboard.posts.filter') }}" method="GET">
                            <div class="form-group">
                                <label for="quantityMin">Минимальное количество</label>
                                <input type="number" class="form-control" id="quantityMin" name="quantity_min" placeholder="От">
                            </div>
                            <div class="form-group">
                                <label for="quantityMax">Максимальное количество</label>
                                <input type="number" class="form-control" id="quantityMax" name="quantity_max" placeholder="До">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Применить</button>
                        </form>
                        <form action="{{ route('admin.dashboard.posts.filter') }}" method="GET">
                            <button type="submit" class="btn btn-warning btn-sm px-4 py-2 ml-5" value="">Сбросить</button>
                        </form>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.dashboard.posts.search', ['query' => request('query')]) }}" method="GET" class="d-flex">
                <div class="d-flex">
                    <input type="text" name="query" class="form-control" placeholder="Поиск..." value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary mb-2">Поиск</button>
                </div>
            </form>
            <div>
                <a href="{{ route('admin.dashboard.posts.export') }}" class="btn btn-info">Экспорт в Excel</a>
            </div>
        </div>
        <form action="{{route('admin.dashboard.posts.process')}}" method="POST">
        @csrf
            <button class="btn btn-success mb-3">Принять в обработку</button>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Склад</th>
                                <th>Город</th>
                                <th>Карта</th>
                                <th>Штук</th>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td><input type="checkbox" name="selected_posts[]" class="row-checkbox" value="{{ $post->id }}"></td>
                                    <td><a href="{{ route('admin.dashboard.posts.show', $post->id) }}" class="text-decoration-none text-dark">{{ $post->warehouse }}</a></td>
                                    <td><a href="{{ route('admin.dashboard.posts.show', $post->id) }}" class="text-decoration-none text-dark">{{ $post->city }}</a></td>
                                    <td><a href="{{ route('admin.dashboard.posts.show', $post->id) }}" class="text-decoration-none text-dark">{{ $post->card }}</a></td>
                                    <td><a href="{{ route('admin.dashboard.posts.show', $post->id) }}" class="text-decoration-none text-dark">{{ $post->quantity }}</a></td>
                                    <td><a href="{{ route('admin.dashboard.posts.show', $post->id) }}" class="text-decoration-none text-dark">{{ $post->date }}</a></td>
                                    <td><a href="{{ route('admin.dashboard.posts.show', $post->id) }}" class="text-decoration-none text-dark">{{ $post->status }}</a></td>
                                    <td>

                                        <a href="{{ route('admin.dashboard.posts.edit', $post) }}" class="btn btn-primary btn-sm">Редактировать</a>
                                        <form action="{{route('admin.dashboard.posts.close')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{$post->id}}">
                                            <button class="btn btn-danger btn-sm">Закрыть</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $posts->links() }}
                </div>
            </div>
        </form>

    </div>

<script>
    document.getElementById('statusFilter').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>
@endsection
