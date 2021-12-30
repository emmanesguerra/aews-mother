@include('header')
<div class="p-3">

    <div class="row">
        <div class="col-sm-12 mb-5">
            @include('navigation')
        </div>
    </div>
    <div class="title m-b-md">
        Create Customer Record
    </div>
    <a href="{{ route('customer.index') }}">Return to CUSTOMER LIST</a>



    <form method="POST" action="{{ route('customer.store') }}" class='col-sm-8 my-5'>

        @if(Session::has('status-error'))
        <p class="alert alert-danger">{{ Session::get('status-error') }}</p>
        @endif

        @csrf

        <div class='row mb-3'>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">First Name</label>
                    <input maxlength="150" type="text" class="form-control" name="first_name" value='{{ old('first_name') }}' style='text-transform: uppercase'>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Last Name</label>
                    <input maxlength="50" type="text" class="form-control" name="last_name" value='{{ old('last_name') }}'  style='text-transform: uppercase'>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Nick Name *</label>
                    <input maxlength="100" type="text" class="form-control" name="nick_name" value='{{ old('nick_name') }}' required style='text-transform: uppercase'>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-12'>
                <div class="form-group">
                    <label style='font-weight: bold'>Contact Number</label>
                    <input maxlength="20" type="number" class="form-control" name="contact_number" value='{{ old('contact_number') }}'  style='text-transform: uppercase'>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-12'>
                <div class="form-group">
                    <label style='font-weight: bold'>Address</label>
                    <textarea maxlength="500" class="form-control" name="contact_address" style='text-transform: uppercase' rows='4'>{{ old('contact_address') }}</textarea>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-6'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Barangay</label>
                    <input maxlength="50" type="text" class="form-control" name="barangay" value='{{ old('barangay') }}'  style='text-transform: uppercase'>
                </div>
            </div>
            <div class='col-sm-6'>
                <div class="form-group">
                    <label style='font-weight: bold' for="">Landmark</label>
                    <input maxlength="150" type="text" class="form-control" name="landmark" value='{{ old('landmark') }}'  style='text-transform: uppercase'>
                </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class='col-sm-4'>
                <div class="form-group">
                    <label style='font-weight: bold'>Current Balance</label>
                    <input type="number" class="form-control" name="current_balance" value='{{ old('current_balance', 0) }}'  style='text-transform: uppercase'>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@include('footer')
