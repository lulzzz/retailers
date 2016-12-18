@extends('carter::stand_alone')

@section('content')
    <section class="hero is-primary is-bold is-fullheight">
        <div class="hero-body">
            <div class="container">

                <div class="columns">
                    <div class="column is-4 is-offset-4">

                        <div class="panel">
                            <div class="panel-heading">

                                @if (count($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                        <div class="notification is-danger">
                                            <p class="title">
                                                Oh, No!
                                            </p>
                                            <p class="subtitle">
                                                {{ $error }}
                                            </p>
                                        </div>
                                    @endforeach
                                @endif

                                <form action="{{ route('carter.install') }}" method="post">

                                    {{ csrf_field() }}

                                    @if ($plans)
                                    <p class="control">
                                        <span class="select is-fullwidth">
                                            <select name="plan">
                                                @foreach ($plans as $key => $plan)
                                                    <option value="{{ $key }}">{{ format_carter_plan($plan) }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </p>
                                    @endif

                                    <p class="control">
                                        <input type="text" class="input is-large" name="shop" placeholder="Shop Domain"/>
                                    </p>

                                    <p class="control">
                                        <input type="password" class="input is-large" name="password" placeholder="Password"/>
                                    </p>

                                    <p class="control">
                                        <button class="button is-primary is-fullwidth">Sign Up</button>
                                    </p>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@stop