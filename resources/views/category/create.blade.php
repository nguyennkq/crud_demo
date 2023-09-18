@extends('layout')

@section('content')
    <div class="controller">
        <form action="{{ route('category.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input id="image" type="file"
                    class="form-control image-file @error('image') is-invalid @enderror" name="image"
                    accept="image/*">
                <img id="image_preview"
                    src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt=""
                    width="100px">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
