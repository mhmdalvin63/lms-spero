@extends('back.templates.pages')
@section('title', isset($title) ? $title : 'Create')
@section('content')
<style>
  .tab {
      display: none;
  }
  input {
    padding: 10px;
    width: 100%;
    border: 1px solid #aaaaaa;
  }
  textarea {
    padding: 10px;
    width: 100%;
    border: 1px solid #aaaaaa;
  }
  .step {
    height: 10;
    width: 10;
    margin: 0 2px;
    background-color: #bbbbbb;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }
  .step.active {
    opacity: 1;
  }
</style>

<div class="row">
  <div class="col-xl-12">
    <div class="form-input-content">
      <div class="card login-form mb-0">
          <div class="card-body pt-5">
              <h4 class="card-title">@yield('title')</h4>
    
                @if(Session::get('fail'))
                  <div class="alert alert-danger alert-dismissible fade show">
                      {{ Session::get('fail') }}
                  </div>
                @endif
    
              <form id="regForm" action="{{ route('superadmin.agency.store') }}" method="POST" class="">
                @csrf
                  <div class="tab">
                    <div class="form-group">
                      <label>Director Name</label>
                      <input type="text" name="name" oninput="this.className = ''" value="{{ $director->name ?? '' }}" class="form-control" placeholder="Name">
                      <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="date" name="date_of_birth" oninput="this.className = ''" value="{{ $director->date_of_birth ?? '' }}" class="form-control" placeholder="">
                        <span class="text-danger">@error('date_of_birth'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" oninput="this.className = ''" value="{{ $director->email ?? '' }}" class="form-control" placeholder="Email">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Phone Number</label>
                        <input type="number" name="phone_number" oninput="this.className = ''" value="{{ $director->phone_number ?? '' }}" class="form-control" placeholder="Phone Number">
                        <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <textarea name="address" oninput="this.className = ''" class="form-control h-150px" rows="3" id="comment" placeholder="Address">{{ $director->address ?? '' }}</textarea>
                      <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                    </div>
                  </div>

                  <div class="tab">
                    <div class="form-group">
                        <label>Business Name</label>
                        <input type="text" name="business_name" oninput="this.className = ''" value="{{ $agency->business_name ?? '' }}" class="form-control" placeholder="Business Name">
                        <span class="text-danger">@error('business_name'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Business Identification Number</label>
                        <input type="number" name="business_identification_number" oninput="this.className = ''" value="{{ $agency->business_identification_number ?? '' }}" class="form-control" placeholder="Business Identification Number">
                        <span class="text-danger">@error('business_identification_number'){{ $message }}@enderror</span>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Telephone Number</label>
                        <input type="number" name="telephone_number" oninput="this.className = ''" value="{{ $agency->phone_number ?? '' }}" class="form-control" placeholder="Telephone Number">
                        <span class="text-danger">@error('telephone_number'){{ $message }}@enderror</span>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" oninput="this.className = ''" value="{{ $agency->email ?? '' }}" class="form-control" placeholder="Email">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="text" name="password" oninput="this.className = ''" value="{{ $agency->password ?? '' }}" class="form-control" placeholder="Password">
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <textarea name="address" oninput="this.className = ''" class="form-control h-150px" rows="3" id="comment" placeholder="Address">{{ $agency->address ?? '' }}</textarea>
                      <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                    </div>
                  </div>
                  <button type="button" id="prevBtn" class="btn btn-dark" onclick="nextPrev(-1)">Previous</button>
                  <button type="button" id="nextBtn" class="btn btn-dark" onclick="nextPrev(1)">Next</button>
                  <div class="text-center mt-2">
                    <span class="step"></span>
                    <span class="step"></span>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
  var currentTab = 0;
  showTab(currentTab);
  function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    fixStepIndicator(n)
  }
  function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
      document.getElementById("regForm").submit();
      return false;
    }
    showTab(currentTab);
  }
  function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].querySelectorAll('input');
    for (i = 0; i < y.length; i++) {
      if (y[i].value == "") {
        y[i].className += " invalid";
        valid = false;
      }
    }
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid;
  }
  function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    x[n].className += " active";
  }
</script>
@endsection