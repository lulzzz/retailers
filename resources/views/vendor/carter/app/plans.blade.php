@extends('carter::embedded')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.3/css/bulma.min.css">
@stop

@section('content')
    <section class="hero is-light is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-4 is-offset-4">
                        <form action="{{ route('carter.plan.create') }}">

                            {{ csrf_field() }}

                            <p class="control">
                                <span class="select is-fullwidth">
                                    <select name="plan">
                                        @foreach ($plans as $key => $plan)
                                        <option value="{{ $key }}"></option>
                                        @endforeach
                                    </select>
                                </span>
                            </p>

                            <p class="control">
                                <button class="button is-primary is-fullwidth">Select Plan</button>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
