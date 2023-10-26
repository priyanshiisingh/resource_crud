<!DOCTYPE html>
<html>
<head>
    <title>Shark App</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('sharks') }}">shark Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('sharks') }}">View All sharks</a></li>
        <li><a href="{{ URL::to('sharks/create') }}">Create a shark</a>
    </ul>
</nav>

<h1>Edit {{ $shark->name }}</h1>

<!-- if there are creation errors, they will show here -->
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<form action="{{ route('sharks.update', $shark->id) }}" method="POST">
    @method('PUT')
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $shark->name }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ $shark->email }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="shark_level">Shark Level</label>
        <select name="shark_level" class="form-control">
            <option value="0" @if($shark->shark_level == 0) selected @endif>Select a Level</option>
            <option value="1" @if($shark->shark_level == 1) selected @endif>Sees Sunlight</option>
            <option value="2" @if($shark->shark_level == 2) selected @endif>Foosball Fanatic</option>
            <option value="3" @if($shark->shark_level == 3) selected @endif>Basement Dweller</option>
        </select>
    </div>

    <input type="submit" value="Edit the shark!" class="btn btn-primary">
</form>


</div>
</body>
</html>