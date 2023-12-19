{{-- <x-head/>
<form action="/">
    <input type="text" placeholder="search" name="search" 
    value=" {{ request('search') }}"
    >
    <button type="submit">Search here</button>
</form>

@forelse ($blogs as $blog)
    <h3><a href="/blogs/{{ $blog->id }}">
        {{ $blog->title }}
    </a>
    </h3>
    <p>Body -{{ $blog->body }} </p>
    <p><a href="/categories/{{$blog->category->slug}}">
        Category -{{ $blog->category->title }} 
    </a>
    </p>
    <p>
        <a href="/users/{{ $blog->user->username }}">
        User - {{ $blog->user->name }}
        </a>
    </p>
@empty
    <p>No blogs found</p>
@endforelse
<x-foot/> --}}
<!-- navbar -->
      
      <x-layout>
        <x-hero/>
        <x-blog_section 
        :blogs="$blogs" 
        :currentCategory="$currentCategory??null"/>
        <x-subscribe/>
      </x-layout>

