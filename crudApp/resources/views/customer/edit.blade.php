@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <h3>Customers</h3>
        <div class="card">
            <div class="card-header">
                <div class="row"> 
                    <div class="col-md-2">
                        <a href="{{ route('customers.index') }}" class="btn" style="background-color: #4643d3; color: white;"><i class="fas fa-chevron-left"></i> Back</a>
                    </div>

                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <img style="width: 100px" src="{{ asset($customer->image) }}" alt="">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        @error('image')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $customer->first_name }}">
                        </div>
                        @error('first_name')
                            <span class="text text-denger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{  $customer->last_name }} ">
                        </div>
                        @error('last_name')
                            <span class="text text-denger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{  $customer->email  }}">
                        </div>
                        @error('email')
                            <span class="text text-denger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{  $customer->phone }} ">
                        </div>
                        @error('phone')
                            <span class="text text-denger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Bank Account Number</label>
                            <input type="text" class="form-control" name="bank_account_number" value="{{ $customer->bank_account_number  }}">
                        </div>
                        @error('bank_account_number')
                            <span class="text text-denger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">About</label>
                            <textarea name="about" class="form-control"> {{ $customer->phone }}</textarea>
                        </div>
                        @error('about')
                            <span class="text text-denger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-update"></i> Update</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection