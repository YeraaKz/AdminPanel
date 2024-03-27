<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Редактирование поста
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.dashboard.posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="warehouse">Склад</label>
                            <input type="text" class="form-control" id="warehouse" name="warehouse" value="{{ old('warehouse', $post->warehouse) }}" required maxlength="255">
                        </div>

                        <div class="form-group">
                            <label for="city">Город</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $post->city) }}" required maxlength="255">
                        </div>

                        <div class="form-group">
                            <label for="card">Карта</label>
                            <input type="text" class="form-control" id="card" name="card" value="{{ old('card', $post->card) }}" required maxlength="255">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Штук</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $post->quantity) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $post->date) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="New" {{ old('status', $post->status) == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Processed" {{ old('status', $post->status) == 'Processed' ? 'selected' : '' }}>Processed</option>
                                <option value="Closed" {{ old('status', $post->status) == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
