@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-9">
            @include('partials.wall.component')
        </div>
        <div class="col-lg-3">
            @if (Auth::user()->isSuperAdmin())
                @include('partials.sales.component')
                @include('partials.charges.component')
                @include('partials.pending.component')
            @elseif (Auth::user()->role == 'member')
                @include('partials.active_subscription')
                @include('partials.member.component')
            @endif
            @include('booking::partials.upcoming_events')
            @include('partials.next_birthday.component')
        </div>
    </div>

@stop


