@extends('layout')

@section('content')
    <a href="{{route('category.index')}}">Danh sách</a>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->image }}</td>
                    <td><img class="" src="{{ asset($value->image) }}" alt="" style="width: 80px;height: 80px">
                    </td>
                    <td>
                        <a href="{{ route('category.restore', $value->id) }}" class="btn btn-secondary">Restore</a>
                        <form action="{{ route('category.permanently.delete', $value->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('chắc chắn xóa?')" class="btn btn-danger"
                                class="btn btn-danger">Xoá </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
