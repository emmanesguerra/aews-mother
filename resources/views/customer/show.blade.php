@include('header')
<div class="p-3">

    <div class="row">
        <div class="col-sm-12 mb-5">
            @include('navigation')
        </div>
    </div>
    <div class="title m-b-md">
        {{ $customer->nick_name }} - {{ $customer->contact_number }} 
    </div>
    <a href="{{ route('customer.index') }}">Return to CUSTOMER LIST</a>

    <div  class='col-sm-8 my-5'>

        @if(Session::has('status-error'))
        <p class="alert alert-danger">{{ Session::get('status-error') }}</p>
        @endif
        <div class='row mb-3'>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">First Name</label>
                    <span class='form-control'>{{ $customer->first_name }}</span>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Last Name</label>
                    <span class='form-control'>{{ $customer->last_name }}</span>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Nick Name *</label>
                    <span class='form-control'>{{ $customer->nick_name }}</span>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-12'>
                <div class="form-group">
                    <label style='font-weight: bold'>Contact Number</label>
                    <span class='form-control'>{{ $customer->contact_number }}</span>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-12'>
                <div class="form-group">
                    <label style='font-weight: bold'>Address</label>
                    <span class='form-control'>{{ $customer->contact_address }}</span>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-6'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Barangay</label>
                    <span class='form-control'>{{ $customer->barangay }}</span>
                </div>
            </div>
            <div class='col-sm-6'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Landmark</label>
                    <span class='form-control'>{{ $customer->landmark }}</span>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold'>Current Balance</label>
                    @if($customer->current_balance > 0)
                    <span class='form-control alert-danger'>{{ $customer->current_balance }}</span>
                    @else
                    <span class='form-control'>{{ $customer->current_balance }}</span>
                    @endif
                </div>
            </div>
            @if($customer->current_balance > 0)
            <form method="POST" action="{{ route('customer.pay', $customer->id) }}" class='col-sm-6'>

                @csrf
                <div class='row'>
                    <div class='col-sm-4'>
                        <div class="form-group">
                            <label style='font-weight: bold'>Pay Amount</label>
                            <input type="number" class="form-control" name="pay_amount" value='{{ old('pay_amount', 0) }}'  style='text-transform: uppercase'>
                        </div>
                    </div>
                    <div class='col-sm-7'>
                        <div class="form-group">
                            <button type="submit" class="btn  alert alert-primary" style='font-weight: bold'>Submit Payment</button>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>


    @if(Session::has('status-balance-success'))
    <p class="alert alert-success">{{ Session::get('status-balance-success') }}</p>
    @endif


    <div class="row">
        <div class="col-sm-12">
            <h4>Payment History</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th class=" text-center" scope="col">#</th>
                        <th class=" text-center" scope="col">Old Balance</th>
                        <th class=" text-center" scope="col">Paid Amount</th>
                        <th class=" text-center" scope="col">New Balance</th>
                        <th class=" text-center" scope="col">Date Paid</th>
                        <th class=" text-center" scope="col">Date Canceled</th>
                        <th class=" text-center" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phs as $ph)
                    @if($ph->date_canceled)
                    <tr class="table-danger">
                        @else
                    <tr class="table-primary">
                        @endif
                        <th class=" text-center" scope="row">{{ $ph->id }}</th>
                        <td class=" text-center">{{ number_format($ph->old_balance, 2) }}</td>
                        <td class=" text-center">{{ number_format($ph->pay_amount, 2) }}</td>
                        <td class=" text-center">{{ number_format($ph->new_balance, 2) }}</td>
                        <td class=" text-center">{{ $ph->created_at->format('M d Y h:i A') }}</td>
                        @if($ph->date_canceled)
                        <td class=" text-center">{{ $ph->date_canceled->format('M d Y h:i A') }}</td>
                        @else
                        <td class=" text-center">&nbsp;</td>
                        @endif
                        <th class=" text-center" scope="col">
                            @if($ph->can_cancel)
                            <a href="{{ route('payhistory.revert', $ph->id) }}" class="text-danger">Revert</a>
                            @endif
                        </th>
                    </tr>
                    @endforeach 
                </tbody>
            </table>

            {{ $phs->withQueryString()->links() }}
        </div>
    </div>
</div>
@include('footer')
