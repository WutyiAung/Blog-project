<x-layout>
    <div class="container">
      <div class="row mt-5 my-5 justify-content-center">
          <div class="col-6">
              <h3 class="text-center">Login Form</h3>
              <form action="/login" method="POST">
                  @csrf
                  
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
  
                    @error('email')
                     <p class="text-danger">{{$message}}</p>
                    @enderror
  
                  </div>
      
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
  
                    @error('password')
                     <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
      
                  <button type="submit" class="btn btn-primary">Submit</button>
      
                </form>
          </div>
      </div>
    </div>
  
  </x-layout>