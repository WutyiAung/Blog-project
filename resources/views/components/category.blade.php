@props(['categories','currentCategory'])
<div class="">
    <div class="dropdown text-center my-3">
      <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{  isset($currentCategory) ? $currentCategory->title : "filter by category"}}
      </button>
      <ul class="dropdown-menu">
        <li>
             @foreach ($categories as $category)
               <a class="dropdown-item" href="/?category={{$category->slug}}
                {{ request('search') ?'&search='.request('search') : ''}}"> 
                 {{$category->title}}
                </a>
             @endforeach   
        </li>
      </ul>
    </div>