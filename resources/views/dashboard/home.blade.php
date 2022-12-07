@extends('layouts.admin')

@section('content')
<div class="px-md-10 pt-md-10 pb-md-5">
  <!--begin::Block-->
  <div class="text-center mb-20">
    <h1 class="fs-2tx fw-bolder mb-8">
    Welcome
    <span class="d-inline-block position-relative ms-2">
      <span class="d-inline-block mb-2">{{ Auth::guard('user')->user()->name }}</span>
      <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-success translate rounded"></span>
    </span></h1>
    <div class="fw-bold fs-2 text-gray-500 mb-10">The most advanced
    <span class="fw-bolder text-gray-900">Bootstrap 5</span>&#160;foundation with a solid design system,
    <br />extensive utility classes and custom made
    <span class="fw-bolder text-gray-900">in-house</span>&#160;components.</div>
  </div>
  <!--end::Block-->
</div>
@endsection