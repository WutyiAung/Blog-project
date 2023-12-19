@props(['blog'=>null,'categories'])
<form action="{{ $blog ? '/admin/blogs/' .$blog->id.'/update'
              : '/admin/blogs/store' }} " method="POST"
              enctype="multipart/form-data">
    @csrf
    @if ($blog)
     @method('PUT')
    @endif
    <div class="mb-3 form-group">
        <label for="title" class="form-label">Blog Title</label>
        <input type="text" class="form-control" placeholder="Enter Title" 
         name="title" value="{{$blog ?->title}}">
        @error('title')
           <p class="text-danger">{{$message }}</p>
        @enderror
    </div>
    @if ($blog)
      
       <img src="{{$blog->photo}}" alt="" width="200" height="200">
    @endif
   
    <div class="mb-3 form-group">
        <label for="photo" class="form-label">Blog photo</label>
        <input type="file" class="form-control" placeholder="Enter Title" 
         name="photo" >
        @error('photo')
           <p class="text-danger">{{$message }}</p>
        @enderror
    </div>

    <div class="mb-3 form-group">
        <label for="slug" class="form-label">slug</label>
        <input type="text"  name="slug" class="form-control" 
        placeholder="Enter slug"  value="{{$blog?->slug}}">
        @error('slug')
        <p class="text-danger">{{$message }}</p>
        @enderror
    </div>

    <div class=" mb-3 form-group">
        <label for="body">Blog Body</label>
        <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$blog?->body}}</textarea>
        @error('body')
        <p class="text-danger">{{$message }}</p>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail1"> Category</label>
        <select
            name="category_id"
            class="form-control"
            id=""
        >
            @foreach ($categories as $category)
            <option {{ $category->id == $blog?->category->id ? 'selected' : '' }}
            value="{{$category->id}}">{{ $category->title }}</option>
            @endforeach
        </select>
        @error('category_id')
        <p class="text-danger">{{$message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-3" >
       {{ $blog ? 'Update' : 'Create'}} 
    </button>
</form>