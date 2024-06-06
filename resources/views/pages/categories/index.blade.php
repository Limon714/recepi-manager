<!-- resources/views/categories/index.blade.php -->

@extends('../layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Category Management</h2>
    </div>
    <div class="col-md-6 text-end">
        <a class="btn btn-success" href="{{ route('categories.create') }}">Create New Category</a>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>
            <td>
                @if ($category->image)
                <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}" width="100">
                @endif
            </td>
            <td>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('categories.subcategories', $category->id) }}">View Details</a>
                    <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this category?');
}
</script>

@endsection