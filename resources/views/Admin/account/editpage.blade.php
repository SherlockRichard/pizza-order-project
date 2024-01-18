@extends('admin.layout.master')

@section('title', 'Account Edit Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('admin#categorylist') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            {{-- <!--Change Password Message -->
            @if (session('noMatch'))
                <div class="my-4 alert alert-success alert-dismissible fade show d-flex align-items-center col-9 "
                    role="alert">
                    {{ session('noMatch') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif --}}

            <!--Change Password Message End -->
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Account </h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#accountEdit', Auth::user()->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex px-3  align-items-center">
                                <div class="col-5 mr-5">
                                    {{-- image --}}
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('admin/images/default_profile.jpg') }}" class="img-thumbnail"
                                            alt="Default Image" />
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail"
                                            alt="Default Image" />
                                    @endif

                                    <input type="file" name="image" class="mt-5">

                                </div>
                                <div class="">
                                    {{-- deatils --}}
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" name="name"
                                            value="{{ old('name', Auth::user()->name) }}"type="text"
                                            class="form-control @error('name')is-invalid @enderror" aria-required="true"
                                            aria-invalid="false" placeholder="name">
                                        @error('name')
                                            <small class= "text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="control-label mb-1">Email</label>
                                        <input id="email" name="email"
                                            value="{{ old('email', Auth::user()->email) }}"type="text"
                                            class="form-control @error('email')is-invalid @enderror" aria-required="true"
                                            aria-invalid="false" placeholder="email">
                                        @error('email')
                                            <small class= "text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="control-label mb-1">Phone</label>
                                        <input id="phone" name="phone"
                                            value="{{ old('phone', Auth::user()->phone) }}"type="text"
                                            class="form-control @error('email')is-invalid @enderror" aria-required="true"
                                            aria-invalid="false" placeholder="phone">
                                        @error('phone')
                                            <small class= "text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="role" class="control-label mb-1">Role</label>
                                        <input disabled id="role" name="role"
                                            value="{{ old('email', Auth::user()->role) }}"type="text"
                                            class="form-control @error('role')is-invalid @enderror" aria-required="true"
                                            aria-invalid="false" placeholder="role">

                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control" cols="30" rows="5">{{ Auth::user()->address }}</textarea>
                                        @error('address')
                                            <small class= "text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary mt-2 w-100"><i
                                            class="fa-solid fa-pen mr-2"></i>Edit</button>




                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
