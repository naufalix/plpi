@extends('layouts.auth')

@section('content')
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/ceres-html-pro/assets/media/illustrations/dozzy-1/14.png">
  <!--begin::Content-->
  <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
    <!--begin::Wrapper-->
    <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
      <div class="row mb-10">
        <img alt="Logo" src="/assets/img/logo/logo-blue.png" class="h-50px w-auto mx-auto" />
      </div>
      <!--begin::Form-->
      <form method="post" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="" method="post">
        @csrf
        <!--begin::Heading-->
        {{-- <div class="text-center mb-10">
          <h1 class="text-dark mb-3">Sign In to Ceres HTML Pro</h1>
        </div> --}}
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
          <label class="form-label fs-6 fw-bolder text-dark">Email</label>
          <input class="form-control form-control-lg form-control-solid" type="text" name="email" required/>
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
          <!--begin::Wrapper-->
          <div class="d-flex flex-stack mb-2">
            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
            <!-- 
              <a href="/ceres-html-pro/?page=authentication/sign-in/password-reset" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
               -->
          </div>
          <!--end::Wrapper-->
          <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" required/>
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center">
          <!--begin::Submit button-->
          <button type="submit" id="kt_sign_in_submit" name="login" class="btn btn-lg btn-primary w-100 mb-5">
          <span class="indicator-label">Login</span>
          <span class="indicator-progress">Please wait... 
          <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
          </button>
          <!--end::Submit button-->
        </div>
        <!--end::Actions-->
      </form>
      <!--end::Form-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Content-->
  <!--begin::Footer-->
  <div class="d-flex flex-center flex-column-auto p-10">
    <!--begin::Links-->
    <div class="d-flex align-items-center fw-bold fs-6">
      <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
      <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
      <a href="https://keenthemes.com/products/ceres-html-pro" class="text-muted text-hover-primary px-2">Contact Us</a>
    </div>
    <!--end::Links-->
  </div>
  <!--end::Footer-->
</div>
@endsection