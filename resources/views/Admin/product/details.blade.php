@extends('admin.layout.master')

@section('title', 'Product Detail')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-8 offset-2">
                <div class="card" style="min-height: 300px">
                    <div class="card-body">
                        <div class="d-flex " style="min-height: 300px">
                            <div class="mr-5">
                                <img style="width:250px" class="rounded" src="{{ asset('storage/' . $products->image) }}"
                                    alt="">

                            </div>
                            <div class=" " style="position: relative">
                                <h2>{{ $products->name }}</h2>

                                <div class="mt-2">
                                    <span class="btn btn-secondary"><i
                                            class="fa-solid fa-tag mr-2"></i>{{ $products->price }}</span>
                                    <span class="btn btn-secondary"><i
                                            class="fa-solid fa-eye mr-2"></i>{{ $products->view_count }}</span>
                                    <span class="btn btn-secondary"><i
                                            class="fa-solid fa-clock mr-2"></i>{{ $products->waiting_time }}</span>
                                    <span class="btn btn-secondary">
                                        <i
                                            class="fa-solid fa-calendar mr-2"></i>{{ $products->created_at->format('d-M-Y') }}</span>

                                </div>
                                <div class="mt-2 text-wrap">
                                    <p style="width: 350px" class="text-justify">
                                        {{ $products->description }}
                                    </p>
                                </div>
                                <div class=" w-100 d-flex justify-content-between " style="position: absolute;bottom:0;">
                                    <a href="{{ route('admin#productList') }}" class="btn btn-dark ">Back</a>
                                    <a href="{{ route('admin#productEditPage', $products->id) }}"
                                        class="btn btn-primary ">Edit</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
