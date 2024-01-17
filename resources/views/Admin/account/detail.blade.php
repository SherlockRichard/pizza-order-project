@extends('admin.layout.master')

@section('title', 'Account Detail')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('admin#categorylist') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
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
                            <h3 class="text-center title-2">Account Information</h3>
                        </div>
                        <hr>
                        <div class="d-flex px-3  align-content-center">
                            <div class="col-5 mr-5">
                                {{-- image --}}
                                <img src="{{ asset('admin/images/default_profile.jpg') }}" class="img-thumbnail"
                                    alt="Default Image" />
                                <button class="btn btn-primary mt-2 w-100"><i class="fa-solid fa-pen mr-2"></i>Edit</button>

                            </div>
                            <div class="">
                                {{-- deatils --}}
                                <p class ="mb-2" style="font-size: 1em">
                                    <i class="fa-solid fa-user mr-3"></i>{{ Auth::user()->name }}
                                </p>
                                <p class ="mb-2" style="font-size: 1em">
                                    <i class="fa-solid fa-envelope mr-3"></i>{{ Auth::user()->email }}
                                </p>
                                <p class ="mb-2" style="font-size: 1em">
                                    <i class="fa-solid fa-phone mr-3"></i>{{ Auth::user()->phone }}
                                </p>
                                <p class ="mb-2 text-uppercase"style="font-size: 1em">
                                    <i class="fa-solid fa-circle-exclamation mr-3"></i>{{ Auth::user()->role }}
                                </p>
                                <p class ="mb-2"style="font-size: 1em">
                                    <i class="fa-solid fa-map mr-3"></i>{{ Auth::user()->address }}
                                </p>
                                <p class="mb-2" style="font-size: 1em">
                                    <i class="fa-solid fa-calendar mr-3"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                </p>



                            </div>
                        </div>
                        {{-- <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
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
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
