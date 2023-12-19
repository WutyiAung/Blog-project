@props(['blogs','categories','currentCategory']);
<x-category :currentCategory='$currentCategory'/>

<section class="container text-center" id="blogs">
    <h1 class="display-5 fw-bold mb-4">Blogs</h1>
    <form action="/" class="my-3">
      <div class="input-group mb-3">

        <input type="hidden" 
         value="{{request('category')}}"
         name="category" >
         
         <input type="hidden"
           value="{{request('username')}}"
           name="username">
           
        <input
          type="text"
          autocomplete="false"
          class="form-control"
          name="search"
          placeholder="Search Blogs..."
          value="{{request('search')}}"
        />
        <button
          class="input-group-text bg-primary text-light"
         
          id="basic-addon2"
          type="submit"
        >
          Search
        </button>
      </div>
    </form>
    <div class="row">
      @foreach ($blogs as $blog)
        <div class="col-md-4 mb-4">
          <x-blog_card :blog="$blog" />
        </div>
      @endforeach
    </div>
    {{ $blogs->links() }}
  </section>