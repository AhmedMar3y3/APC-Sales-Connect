<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Forgot Password - Supervisor</title>
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
  <main>
    <div class="container">
      <section class="section min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title text-center">Forgot Password</h5>
              <p class="text-center">Enter your email to receive a reset code</p>
              @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
              @endif
              @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
              @endif
              <form action="{{ route('supervisor.forgotPassword') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" required>
                  @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Reset Code</button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</body>

</html>
