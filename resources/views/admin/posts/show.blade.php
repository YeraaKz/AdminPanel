<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" >Панель Управления</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.dashboard.')}}">Главная <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</nav>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Post Details</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><strong>Warehouse: </strong>{{ $post->warehouse }}</h5>
                    <p class="card-text"><strong>City:</strong> {{ $post->city }}</p>
                    <p class="card-text"><strong>Card:</strong> {{ $post->card }}</p>
                    <p class="card-text"><strong>Quantity:</strong> {{ $post->quantity }}</p>
                    <p class="card-text"><strong>Date:</strong> {{ $post->date }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $post->status }}</p>
                    <a href="{{ route('admin.dashboard.posts.edit', $post) }}" class="btn btn-primary">Edit Post</a>
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
