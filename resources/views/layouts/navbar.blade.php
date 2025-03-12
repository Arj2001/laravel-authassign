<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Posts</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">Home</a>
          <a class="nav-link" href="{{ route('posts.create') }}">Create Post</a>
          <a class="nav-link" href="/posts/user/{{Auth::user()->id}}">View My Post</a>
          <a class="nav-link" href="/">Logout</a>
        </div>
        <div class="d-flex navbar-nav ms-auto">
            <a class="nav-link" href="/user">{{Auth::user()->name}}</a>
        </div>
      </div>
    </div>
  </nav>
