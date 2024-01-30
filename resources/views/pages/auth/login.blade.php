@extends('layouts.auth')

@section('content')
<section class="login-container">
  <div class="login-card">
    <div class="login-card-header">
      <h2>Login</h2>
    </div>
    <div class="login-card-content">
      <form action="">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">No KK / Email</label>
          <input type="email" class="form-control" id="email">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Password</label>
          <input type="password" class="form-control" id="password">
        </div>
        <div class="btn-container">
          <button type="submit" class="btn btn-submit">Submit</button>
        </div>
        <div class="login-card-footer">
          <li>
            <a href="/register">
              Lupa Password
            </a>
          </li>
          <li>
            <a href="/register">
              Register
            </a>
          </li>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
