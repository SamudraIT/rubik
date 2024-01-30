@extends('layouts.auth')

@section('content')
<section class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header text-white bg-info">
          <h5>Register</h5>
        </div>
        <div class="card-body">
          <form class="account-form">
            @csrf
            <div class="form-section">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" required />
              <label for="name">Password</label>
              <input type="password" name="password" class="form-control" required />
              <label for="name">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" required />
            </div>

            <div class="form-section">
              <label for="name">No KK</label>
              <input type="text" name="card_number" class="form-control" required />
              <label for="name">Alamat</label>
              <input type="text" name="address" class="form-control" required />
              <label for="name">Status Hunian</label>
              <input type="text" name="place_status" class="form-control" required />

              <label for="name">RT</label>
              <input type="text" name="rt" class="form-control" required />
              <label for="name">RW</label>
              <input type="text" name="rw" class="form-control" required />
            </div>

            <div class="form-navigation">
              <button type="button" class="previous btn btn-info float-left">
                Prev
              </button>
              <button type="button" class="next btn btn-info float-right">
                Next
              </button>
              <button type="submit" class="btn btn-success float-right">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
