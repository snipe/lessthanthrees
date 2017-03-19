@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <div id="vue-wrapper">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h2>Subscription Information</h2>

                @if (Auth::user()->subscribed('monthly'))

                        <table class="table table-striped">

                            @foreach (Auth::user()->subscriptions as $subscription)
                                <tr>
                                    <td> {{ $subscription->name }}</td>
                                    <td> {{ $subscription->created_at->format('M d, Y h:iA') }}</td>
                                    <td>
                                        @if ($subscription->ends_at!='' )
                                            Ends {{ $subscription->ends_at }}
                                        @else
                                            <form action="{{ route('account.subscription.cancel') }}" method="post" role="form" style="display: block;">
                                                {{ csrf_field() }}
                                            <input type="submit" name="cancel" class="btn btn-danger" value="Cancel">
                                            </form>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($subscription->ends_at!='' )
                                            <form action="{{ route('account.subscription.reactivate') }}" method="post" role="form" style="display: block;">
                                                {{ csrf_field() }}
                                            <input type="submit" name="cancel" class="btn btn-warning" value="Re-Activate">
                                            </form>
                                        @endif

                                    </td>
                                </tr>

                            @endforeach
                        </table>

                @else



                @endif



                </form>



            </div>
        </div>
    </div>


@endsection
