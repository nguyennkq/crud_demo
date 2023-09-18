@extends('layout')

@section('content')
    <a class="btn btn-primary" href="{{ route('category.deleted') }}">Danh sách xóa mềm</a>
    <a class="btn btn-info" href="{{ route('category.create') }}">Thêm</a>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Image</th>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td><img class="" src="{{ asset($value->image) }}" alt="" style="width: 80px;height: 80px">
                    </td>
                    <td>
                        <a href="{{ route('category.edit', $value->id) }}">Sửa</a>
                        <form action="{{ route('category.destroy', $value->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('chắc chắn xóa?')" class="btn btn-danger"
                                class="btn btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
