@extends('user.layout.master')

@section('title', 'Change Passwrod Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!--Change Password Message -->
            @if (session('noMatch'))
                <div class="my-4 alert alert-success alert-dismissible fade show d-flex align-items-center col-9 "
                    role="alert">
                    {{ session('noMatch') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!--Change Password Message End -->
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password Form</h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                <input id="oldPassword" name="oldPassword" value="{{ old('oldPassword') }}"type="text"
                                    class="form-control @error('oldPassword')is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="oldpassword..">
                                @error('oldPassword')
                                    <small class= "text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newPassword" class="control-label mb-1">New Password</label>
                                <input id="newPassword" name="newPassword" value="{{ old('newPassword') }}"type="text"
                                    class="form-control @error('newPassword')is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="newpassword...">
                                @error('newPassword')
                                    <small class= "text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="comfirmPassword" class="control-label mb-1">Comfirm Password</label>
                                <input id="comfirmpassword" name="comfirmPassword"
                                    value="{{ old('comfirmPassword') }}"type="text"
                                    class="form-control @error('comfirmPassword')is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="comfirmpassword...">

                                @error('comfirmPassword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key"></i>
                                    <span id="payment-button-amount">Change</span>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
