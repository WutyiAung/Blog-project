<div class="card">
    <img
      src="{{ $blog->photo }}"
      class="card-img-top"
      alt="..."
    />
    <div class="card-body">
      <h3 class="card-title">{{$blog->title}}</h3>
      <p>{{substr($blog->body,0,80)}} ...</p>
      <p class="fs-6 text-secondary">
         <a href="/?username={{$blog->user->username}}">
          {{$blog->user->name}}
         </a>
        <span> - 2days ago</span>
      </p>
      <div class="tags my-3">
        <span class="badge bg-primary">
          <a href="/?category={{$blog->category->slug}}" class="text-black">
            {{$blog->category->title}}
          </a>
        
        </span>
        {{-- <span class="badge bg-secondary">Css</span>
        <span class="badge bg-success">Php</span>
        <span class="badge bg-danger">Javascript</span>
        <span class="badge bg-warning text-dark">Frontend</span> --}}
      </div>
      <p class="card-text">
        Some quick example text to build on the Blog title and make up
        the bulk of the card's content.
      </p>
      <a href="/blogs/{{$blog->id}}" class="btn btn-primary">Read More</a>
    </div>
  </div>
  

