@extends('layouts.index')

@section('hero')
  @include('components.hero')
@endsection

@section('content')
  @include('components.about')
  @include('components.clients')
  @include('components.services')
@endsection