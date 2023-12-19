<x-admin_layout>
    
    <h2>Blog list</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">slug</th>
            <th scope="col">category</th>
            <th scope="col" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blogs as $blog)
          <tr>
            <th scope="row">{{$blog->id}}</th>
            <td>{{$blog->title}}</td>
            <td>{{$blog->slug}}</td>
            <td>{{$blog->category->title}}</td>

            @if (auth()->user()->can('edit',$blog))
            <td><a href="/admin/blogs/{{$blog->id}}/edit" class="btn btn-warning">Edit</a></td>
            @endif

            @if (auth()->user()->can('delete',$blog))
            <td> 
              <form action="/admin/blogs/{{$blog->id}}/destroy" method="POST">
              @csrf
              @method('delete')
              <button class="btn btn-danger" type="submit">Delete</button>
              </form>
             </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$blogs->links() }}
</x-admin_layout>
          
                                                    