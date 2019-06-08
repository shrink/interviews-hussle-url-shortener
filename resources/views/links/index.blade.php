@extends('layouts.page')

@section('body')
  @include('components.stats')
  <hr class="bb bw1 b--black-05 mv3">

  <form class="black-80" method="POST" action="{{ route('links.create') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <label for="location" class="f6 b db mb2">URL</label>

    <input
        id="location"
        name="location"
        class="input-reset ba b--black-20 pa2 mb2 db w-100 @if ($errors->has('location')) bw-1 b--red @endif"
        type="text"
        aria-describedby="location-desc"
        required
        placeholder="https://www.example.com">

    @if ($errors->has('location'))
      <small id="location-error" class="f6 red db mb2">{{ $errors->first('location') }}</small>
    @endif

    <small id="location-desc" class="f6 black-60 db mb2">Required, valid URL.</small>
    <div class="mt3">
      <input
        class="input-reset f6 link b br2 ph3 pv2 mb2 dib white bg-pink bn pointer courier"
        type="submit"
        value="Shorten URL">
    </div>
  </form>
@endsection
