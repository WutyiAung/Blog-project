@props(['category' => null])

    <div class="container">
        <h2>{{ $category ? 'Edit Category' : 'Create New Category' }}</h2>
        <form action="{{ $category ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
            @csrf
            @if($category)
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{$category ?->title}}" required>
                @error('title')
                <p class="text-danger">{{$message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">slug</label>
                <input type="text" class="form-control"  name="slug" value="{{$category ?->slug}}" required>
                @error('slug')
                <p class="text-danger">{{$message }}</p>
                @enderror
            </div>
          
            <button type="submit" class="btn btn-primary mt-2">{{ $category ? 'Update' : 'Create' }} Category</button>
        </form>
    </div>

