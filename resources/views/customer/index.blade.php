@include('header')
<div class="p-3">

    <div class="row">
        <div class="col-sm-12 mb-5">
            @include('navigation')
        </div>
    </div>
    <div class="title m-b-md">
        <div class="row">
            <div class="col-sm-12">
                Customer List
                <a class="btn btn-primary" href="{{ route('customer.create') }}" style="float: right">+ Create New Record</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            {{ $customers->withQueryString()->links() }}
        </div>
        <div class="col-sm-12">
            <form class="form-inline" method="GET" action="{{ route('customer.index') }}">
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
                    <div class="col">
                        <div class="form-check m-1">
                            @if(Request::has('wbalance'))
                            <input type="checkbox" name="wbalance" checked class="form-check-input" id="wbalance" onChange="this.form.submit()">
                            @else
                            <input type="checkbox" name="wbalance" class="form-check-input" id="wbalance" onChange="this.form.submit()">
                            @endif
                            <label class="form-check-label" for="defaultCheck1">
                                W/Balance
                            </label>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
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

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class=" text-center" scope="col">#</th>
                        <th class=" text-center" scope="col">Name</th>
                        <th class=" text-center" scope="col">Contact Number</th>
                        <th class=" text-center" scope="col">Current Balance</th>
                        <th class=" text-center" scope="col">Date Added</th>
                        <th width="5%" scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <th class=" text-center" scope="row">{{ $customer->id }}</th>
                        <td class=" text-center"><a class="alert-link" href="{{ route('customer.show', $customer->id) }}">{{ $customer->first_name }} {{ $customer->last_name }} ({{ $customer->nick_name }})</a></td>
                        <td class=" text-center">{{ $customer->contact_number }}</td>
                        @if($customer->current_balance > 0)
                        <td class="table-danger text-center">{{ number_format($customer->current_balance, 2) }}</td>
                        @else
                        <td class=" text-center">0</td>
                        @endif
                        <td class=" text-center">{{ $customer->created_at->format('M d Y h:i A') }}</td>
                        <td class=" text-center">
                            <a class="alert-link" href="{{ route('customer.edit', $customer->id) }}">Update</a>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>

            {{ $customers->withQueryString()->links() }}
        </div>
    </div>
</div>
@include('footer')
