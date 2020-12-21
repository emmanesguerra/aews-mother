<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AE  Purified Drinking Station | Payment History</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-size: 20px;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .title {
                font-size: 64px;
            }
        </style>
    </head>
    <body>
        <div class="p-3">
            <div class="title m-b-md">
                Customer Records
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="btn alert alert-warning" role="alert" style='cursor:default'>
                        <a class="alert-link" href="{{ route('customer.index') }}">Customer Records</a>
                    </div>
                    <div class="btn alert alert-primary" role="alert" style='cursor:default'>
                        <a class="alert-link" href="{{ route('payhistory.create') }}">Download History</a>
                    </div>
                    <div class="btn alert alert-warning" role="alert" style='cursor:default'>
                        <a class="alert-link" href="{{ route('customer.index') }}">Check Order History</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    {{ $phs->withQueryString()->links() }}
                </div>
                <div class="col-sm-6">
                    <form class="form-inline"  method="GET" action="{{ route('payhistory.index') }}">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Show</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name='show' onChange="this.form.submit()">
                                            @foreach([10,15,20,25] as $ctr)
                                            @if(Request::get('show') == $ctr)
                                            <option selected>{{ $ctr }}</option>
                                            @else 
                                            <option>{{ $ctr }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check col-sm-6">
                                <input class="form-control mr-sm-2" type="search" name="search" value='{{ Request::get('search') }}' placeholder="Search" aria-label="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class=" text-center" scope="col">#</th>
                                <th class=" text-center" scope="col">Name Name</th>
                                <th class=" text-center" scope="col">Contact Number</th>
                                <th class=" text-center" scope="col">Old Balance</th>
                                <th class=" text-center" scope="col">Payment</th>
                                <th class=" text-center" scope="col">New Balance</th>
                                <th class=" text-center" scope="col">Date Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phs as $ph)
                            <tr>
                                <th class=" text-center" scope="row">{{ $ph->id }}</th>
                                <td class=" text-center"><a class="alert-link" href="{{ route('customer.show', $ph->customer->id) }}">{{ $ph->customer->first_name }} {{ $ph->customer->last_name }} ({{ $ph->customer->nick_name }})</a></td>
                                <td class=" text-center">{{ $ph->customer->contact_number }}</td>
                                <td class=" text-center">{{ number_format($ph->old_balance, 2) }}</td>
                                <td class=" text-center">{{ number_format($ph->pay_amount, 2) }}</td>
                                <td class=" text-center">{{ number_format($ph->new_balance, 2) }}</td>
                                <td class=" text-center">{{ $ph->created_at->format('M d Y h:i A') }}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>

                    {{ $phs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </body>
</html>
