<x-layout>
  
    <!-- single blog section -->
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto text-center">
          <img
            src="https://creativecoder.s3.ap-southeast-1.amazonaws.com/blogs/GOLwpsybfhxH0DW8O6tRvpm4jCR6MZvDtGOFgjq0.jpg"
            class="card-img-top"
            alt="..."
          />
          <h3 class="my-3">{{$blog->title}}</h3>
            <div>Author -
              <a href="/users/{{$blog->user->username}}">
                {{ $blog->user->name }}
              </a>
            </div>
            <div  clas="badge bg-primary">Category -
              <a href="/categories/{{$blog->category->slug}}">
                {{ $blog->category->title }}
              </a>
            </div>
            <div class="text-secondary">Date -{{ $blog->created_at->diffForHumans() }}</div>
{{--            
             <div>
              <form action="/blogs/{{$blog->slug}}/handle-subscriptions" method="POST">
                @csrf
                @if ( $blog->isSubscribeBy(auth()->user()) )
                    <button class="btn btn-danger mt-2" type="submit">
                      unsubscribe
                    </button>
                @else
                    <button class="btn btn-warning mt-2" type="submit">
                      subscribe
                    </button>
                @endif
              </form>
             </div> --}}

             <div>
              
              <form action="/blogs/{{$blog->slug}}/handle-subscriptions" method="POST">
                @csrf
                @if ($blog->isSubscribeBy(auth()->user()))
                    <button class="btn btn-danger mt-3" type="submit">
                      unsubscribe
                    </button>
                @else
                    <button  type="submit" class="btn btn-warning" >
                        subscribe
                    </button>
                @endif
              </form>
             </div>

          <p class="lh-md mt-3">
            {{$blog->body}}
          </p>
        </div>
      </div>
      
    <div class="container">
        @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
        <div>
          <form action="/blogs/{{$blog->slug}}/comments" method="POST">
            @csrf
            <textarea name="body" id=""
             cols="20" rows="5" class="form-control" placeholder="comment here..."></textarea>
            <button class="btn btn-primary my-3" type="submit">Comment</button>
          </form>
        </div>
      </div>
      <div class="row">
        @foreach ($blog->comments()->with('user')->orderby('id','desc')->get() as $comment)
            <div class="col-4">
                <div class="card" style="width: 22rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$comment->user->name}}</h5>
                        <p class="card-text">{{$comment->body}}</p>
                        <p class="card-text">commented at - {{$comment->created_at->diffForHumans()}}</p>
    
                        <div class="d-flex">
                            @if (auth()->user()->can('edit',$comment))
                            <a href="/comments/{{$comment->id}}/edit" class="btn btn-outline-primary  me-2 h-50">Edit</a>
                            @endif

                            @if (auth()->user()->can('delete',$comment))
                            <form action="/comments/{{$comment->id}}/delete" method="POST">
                              @csrf
                              @method('delete')
                              <button class="btn btn-outline-danger">Delete</button>
                            </form>
                            @endif

                        
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    

    <!-- subscribe new blogs -->
     {{-- <x-subscribe/> --}}
     <x-blogs_you_may_like_section :randomBlogs="$randomBlogs"/>
    <!-- footer -->
</x-layout>