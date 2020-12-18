<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AE  Purified Drinking Station | Customer Records</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="/css/bootstrap.min.css" rel="stylesheet">

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
                    <div class="btn alert alert-primary" role="alert">
                        <a class="alert-link" href="{{ route('customer.index') }}">Add new record</a>
                    </div>
                    <div class="btn alert alert-warning" role="alert">
                        <a class="alert-link" href="{{ route('customer.index') }}">Check Order History</a>
                    </div>
                    <div class="btn alert alert-warning" role="alert">
                        <a class="alert-link" href="{{ route('customer.index') }}">Check Payment History</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    {{ $customers->withQueryString()->links() }}
                </div>
                <div class="col-sm-6">
                    <form class="form-inline"  method="GET" action="{{ route('customer.index') }}">
                        <div class="row">
                            <div class="col-sm-3">
                                @if(Request::has('wbalance'))
                                <input type="checkbox" name="wbalance" checked class="form-check-input my-2" id="wbalance" onChange="this.form.submit()">
                                @else
                                <input type="checkbox" name="wbalance" class="form-check-input my-2" id="wbalance" onChange="this.form.submit()">
                                @endif
                                <label for="wbalance" class="col-form-label">With Balance</label>
                            </div>

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
                                <th class=" text-center" scope="col">First Name</th>
                                <th class=" text-center" scope="col">Last Name</th>
                                <th class=" text-center" scope="col">Nick Name</th>
                                <th class=" text-center" scope="col">Contact Number</th>
                                <th class=" text-center" scope="col" width="10%">Current Balance</th>
                                <th class=" text-center" scope="col">Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <th class=" text-center" scope="row">{{ $customer->id }}</th>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->nick_name }}</td>
                                <td class=" text-center">{{ $customer->contact_number }}</td>
                                @if($customer->current_balance > 0)
                                <td class="table-danger text-center">{{ $customer->current_balance }}</td>
                                @else
                                <td>0</td>
                                @endif
                                <td>{{ $customer->created_at }}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>

                    {{ $customers->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </body>
</html>
