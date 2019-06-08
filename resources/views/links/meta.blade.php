@extends('layouts.page')

@section('body')
  @include('components.stats')
  <hr class="bb bw1 b--black-05 mv3">

  <input
      class="input-reset ba b--black-20 pa2 mb2 db w-100"
      type="text"
      value="{{ $url }}"
      onClick="this.select();"
      readonly>

  <p class="lh-copy">
    <a href="/" class="link pink b">Shorten another URL &rarr;</a>
  </p>
@endsection
