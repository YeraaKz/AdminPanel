<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    svg {
        display: none;
    }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Панель Управления</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Главная <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</nav>

<form action="{{route('admin.dashboard.posts.process')}}" method="POST">
    @csrf
    <div class="container">
        <h1 class="text-center mt-3">Admin panel</h1>
        <div class="mb-2 d-flex justify-content-between">
            <div>
                <form action="{{ route('admin.dashboard.posts.search') }}" method="GET" class="d-flex">
                    <div class="d-flex">
                        <input type="text" name="query" class="form-control" placeholder="Поиск..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary mb-2">Поиск</button>
                    </div>
                </form>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Фильтр
                    </button>
                    <div class="dropdown-menu" aria-labelledby="filterDropdown">
                        <form class="px-4 py-2" action="{{ route('admin.dashboard.posts.filter') }}" method="GET">
                            <div class="form-group">
                                <label for="statusFilter">По статусу</label>
                                <select class="form-control" id="statusFilter" name="status">
                                    <option value="">Выберите статус</option>
                                    <option value="New">New</option>
                                    <option value="Processed">Processed</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Применить</button>
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

                        <div class="dropdown-divider"></div>
                    </div>
                </div>

            </div>

            <div>
                <button class="btn btn-success">Принять в обработку</button>
                <a href="{{ route('admin.dashboard.posts.export') }}" class="btn btn-info">Экспорт в Excel</a>
            </div>
        </div>
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
                                <td>{{ $post->warehouse }}</td>
                                <td>{{ $post->city }}</td>
                                <td>{{ $post->card }}</td>
                                <td>{{ $post->quantity }}</td>
                                <td>{{ $post->date}}</td>
                                <td>{{ $post->status }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Редактировать</button>
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
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
