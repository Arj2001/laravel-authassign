@extends('layouts.afterlogin')
@section('content')

    <div class="container mt-5 w-50">
        <h2>{{ Auth::user()->name }}</h2>
        <form action="{{ route('user.update')}}" method="POST" enctype="multipart/form-data">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            @method('PUT')
            <div class="form-group my-1">
                <label for="title">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required {{ request()->is('user/edit') ? '' : 'readonly' }}>
            </div>
            <div class="form-group my-1">
                <label for="content">Email</label>
                <input type="email" class="form-control " id="email" name="email" value="{{ Auth::user()->email }}" required {{ request()->is('user/edit') ? '' : 'readonly' }}>
            </div>
            @if ( request()->is('user/edit'))
            <button type="submit" class="btn btn-primary my-1">Update</button>
            @else
            <a href="{{ route('user.edit') }}" class="btn btn-primary my-1">Edit</a>
            @endif
        </form>
    </div>
@endsection()
