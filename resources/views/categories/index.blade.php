<x-admin_layout>
    <div class="container mt-3">
        <h2>Categories</h2>
        <a href="/categories/create" class="btn btn-primary mt-2">Create New Category</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>
                            <a href="/category/{{$category->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                            <form action="/category/{{$category->id}}/destroy" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin_layout>