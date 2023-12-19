<x-layout>
<div class="container my-5 text-center">
    <form action="/comments/{{$comment->id}}/edit" method="POST">
     @csrf
     @method('patch')
      <textarea name="body" id="" cols="50" rows="10" class="p-3">
        {{ $comment->body }}</textarea><br>
       @error('body')
           <div class="text-danger">
             {{$message}}
           </div>
       @enderror
       <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
</x-layout>