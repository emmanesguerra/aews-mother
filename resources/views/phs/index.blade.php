@include('header')
<div class="p-3">

    <div class="row">
        <div class="col-sm-12 mb-5">
            @include('navigation')
        </div>
    </div>
    <div class="title m-b-md">
        Payment History
    </div>


    <div class="row">
        <div class="col-sm-6">
            {{ $phs->withQueryString()->links() }}
        </div>
        <div class="col-sm-12">
            <form class="form-inline" method="GET" action="{{ route('payhistory.index') }}">
                <div class="row">
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend d-none d-lg-block">
                                <label class="input-group-text" for="inputGroupSelect01">Show</label>
                            </div>
                            <select class="custom-select form-control" name='show' onChange="this.form.submit()">
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
                    <div class="col-6 offset-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Search</label>
                            </div>
                            <input class="form-control form-control-sm" type="search" name="search" value='{{ Request::get('search') }}' aria-label="Search">
                        </div>
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
@include('footer')