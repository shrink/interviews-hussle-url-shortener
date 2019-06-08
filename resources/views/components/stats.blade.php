<div class="mt1 mb3 roboto">
  <ul class="list ma0 pa0 f6">
    @foreach ($statistics as $statistic)
      <li class="mv1">
        <span class="roboto f6">
          {{ $statistic->amount() }}
        </span>
        {{ $statistic->name() }}
      </li>
    @endforeach
  </ul>
</div>
