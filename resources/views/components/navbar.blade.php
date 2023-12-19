<nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Creative Coder</a>
      <div class="d-flex">
        <a href="/" class="nav-link">Home</a>
        <a href="/#blogs" class="nav-link">Blogs</a>
        
        @if (auth()->check())
          <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>   
          </form>
        @else
            <a href="/register" class="nav-link">Register</a>
            <a href="/login" class="nav-link">Login</a>
        @endif 
        
        {{-- <a href="#subscribe" class="nav-link">Subscribe</a> --}}
      </div>
    </div>
  </nav>