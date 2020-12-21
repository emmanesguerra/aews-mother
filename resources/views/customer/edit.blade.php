<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AE  Purified Drinking Station | Customer Records</title>

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
                Update Customer Record
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="btn alert alert-primary" role="alert" style='cursor:default'>
                        <a class="alert-link" href="{{ route('customer.index') }}">Go Back</a>
                    </div>
                </div>
            </div>



            <form method="POST" action="{{ route('customer.update', $customer->id) }}" class='col-sm-8 offset-sm-2'>

                @if(Session::has('status-error'))
                <p class="alert alert-danger">{{ Session::get('status-error') }}</p>
                @endif

                @csrf
                @method('PATCH')

                <div class='row mb-3'>
                    <div class='col-sm-4'>
                        <div class="form-group">
                            <label style='font-weight: bold' for="">First Name</label>
                            <input maxlength="150" type="text" class="form-control" name="first_name" value='{{ old('first_name', $customer->first_name) }}' style='text-transform: uppercase'>
                        </div>
                    </div>
                    <div class='col-sm-4'>
                        <div class="form-group">
                            <label style='font-weight: bold' for="">Last Name</label>
                            <input maxlength="50" type="text" class="form-control" name="last_name" value='{{ old('last_name', $customer->last_name) }}'  style='text-transform: uppercase'>
                        </div>
                    </div>
                    <div class='col-sm-4'>
                        <div class="form-group">
                            <label style='font-weight: bold' for="">Nick Name *</label>
                            <input maxlength="100" type="text" class="form-control" name="nick_name" value='{{ $customer->nick_name }}' required style='text-transform: uppercase' readonly>
                        </div>
                    </div>
                </div>
                <div class='row mb-3'>
                    <div class='col-sm-12'>
                        <div class="form-group">
                            <label style='font-weight: bold'>Contact Number</label>
                            <input maxlength="20" type="number" class="form-control" name="contact_number" value='{{ old('contact_number', $customer->contact_number) }}'  style='text-transform: uppercase'>
                        </div>
                    </div>
                </div>
                <div class='row mb-3'>
                    <div class='col-sm-12'>
                        <div class="form-group">
                            <label style='font-weight: bold'>Address</label>
                            <textarea maxlength="500" class="form-control" name="contact_address"  style='text-transform: uppercase' rows='4'>{{ old('contact_address', $customer->contact_address) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class='row mb-3'>
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <label style='font-weight: bold' for="">Barangay</label>
                            <input maxlength="50" type="text" class="form-control" name="barangay" value='{{ old('barangay', $customer->barangay) }}'  style='text-transform: uppercase'>
                        </div>
                    </div>
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <label style='font-weight: bold' for="">Landmark</label>
                            <input maxlength="150" type="text" class="form-control" name="landmark" value='{{ old('landmark', $customer->landmark) }}'  style='text-transform: uppercase'>
                        </div>
                    </div>
                </div>
                <div class='row mb-3'>
                    <div class='col-sm-4'>
                        <div class="form-group">
                            <label style='font-weight: bold'>Current Balance</label>
                            
                            @if($customer->current_balance > 0)
                            <span class="form-control alert-danger">{{ $customer->current_balance }}</span>
                            @else
                            <span class="form-control">{{ $customer->current_balance }}</span>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
