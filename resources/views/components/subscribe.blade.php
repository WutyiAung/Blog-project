<section class="container my-4 text-center" id="subscribe">
    <div class="row">
      @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
      @endif
 
      @if(session('error'))
      <div class="alert alert-success">
          {{ session('error') }}
      </div>
     @endif
     
      <div class="col-md-6 mx-auto">
        <h3 class="fw-bold mb-4">Subscribe For new blogs</h3>
        <form action="/subscription" method="POST">
          @csrf
          <div class="mb-3">
            <input
              placeholder="Email Address"
              type="email"
              name="email"
              class="form-control"
              autocomplete="false"
            />
          </div>
          <button type="submit" class="btn btn-primary">Subscribe Now</button>
        </form>
      </div>
    </div>
  </section>
