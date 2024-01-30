@extends('admin.layout.master')

@section('title', 'Product Edit Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('admin#productList') }}"><button class="btn bg-dark text-white my-3">List</button></a>
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
                            <h3 class="text-center title-2">Product Edit </h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#productEdit', $products->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex px-3  align-items-center">
                                <div class="col-5 mr-5">
                                    {{-- image --}}

                                    <img src="{{ asset('storage/' . $products->image) }}" class="img-thumbnail"
                                        alt="Default Image" />


                                    <input type="file" name="pizzaImage" class="mt-5">

                                </div>
                                <div class="">
                                    {{-- Pizza Name --}}
                                    <div class="form-group">
                                        <label for="pizzaName" class="control-label mb-1">Pizza Name</label>
                                        <input id="pizzaName" name="pizzaName" value="{{ $products->name }}"type="text"
                                            class="form-control @error('pizzaName')is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Seafood...">

                                        @error('pizzaName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Category --}}
                                    <div class="form-group">
                                        <label for="pizzaCategory" class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory"
                                            class="form-control @error('pizzaCategory')is-invalid @enderror" id="">
                                            <option value="">Choose a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($products->category_id == $category->id) selected @endif> {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('pizzaCategory')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    {{-- Pizza Description --}}
                                    <div class="form-group">
                                        <label for="pizzaDescription" class="control-label mb-1">Pizza Description</label>
                                        <textarea name="pizzaDescription" class="form-control @error('pizzaDescription')is-invalid @enderror"
                                            id="pizzaDescription" cols="30" rows="5">{{ $products->description }}</textarea>
                                        @error('pizzaDescription')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>


                                    {{-- Waiting Time --}}
                                    <div class="form-group">
                                        <label for="pizzaWaitingTime">Waiting Time (mins)</label>
                                        <input type="text" name="pizzaWaitingTime" value="{{ $products->waiting_time }}"
                                            class="form-control  @error('pizzaWaitingTime')is-invalid @enderror">
                                        @error('pizzaWaitingTime')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    {{-- Price --}}
                                    <div class="form-group">
                                        <label for="pizzaPrice">Price (kyats)</label>
                                        <input type="text" name="pizzaPrice" value="{{ $products->price }}"
                                            class="form-control @error('pizzaPrice')is-invalid @enderror">
                                        @error('pizzaPrice')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>


                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Edit</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>

                                    </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
