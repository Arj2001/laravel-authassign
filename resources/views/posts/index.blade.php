@extends('layouts.afterlogin')
@section('content')
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="row m-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card p-1">
                        <div class="card-header d-flex justify-content-between">
                            <span>
                                {{ $post->title }}
                            </span>
                            <span>
                                {{ $post->user->name }}
                            </span>
                        </div>
                        @if ($post->image != null)
                            <img class="card-img-top" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" height="400px"  />
                        @endif
                        <div class="card-body">
                            <p class="card-text">{{ $post->content }}</p>
                            @if (request()->is('posts/user/' . Auth::user()->id))
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            @if (request()->is('posts/user/' . Auth::user()->id))
                                Likes: {{ $post->likes }}
                            @elseif (App\Models\Likes::isLikedBy($post->id))
                                <span>
                                    {{ $post->likes }}<a href="{{ route('posts.dislike', $post->id) }}"><i
                                            class="bi bi-hand-thumbs-up-fill"></i></a>
                                </span>
                            @else
                                <span>
                                    {{ $post->likes }}<a href="{{ route('posts.like', $post->id) }}"><i
                                            class="bi bi-hand-thumbs-up"></i></a>
                                </span>
                            @endif

                            <span>
                                {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                </div>
                <div class="col-md-3"></div>
            </div>
        @endforeach
    @endif
@endsection()
