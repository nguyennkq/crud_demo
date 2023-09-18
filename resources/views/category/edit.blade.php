@extends('layout')

@section('content')
    <div class="controller">
        <form action="{{ route('category.update', $data->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="" value="{{ $data->name }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input id="image" type="file"
                    class="form-control image-file @error('category_image') is-invalid @enderror" name="category_image"
                    accept="image/*"><br>
                <img id="image_preview"
                    src="{{ $data->image ? Storage::url($data->image) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}"
                    alt="" width="100px" height="100px">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
