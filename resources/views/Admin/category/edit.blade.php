@extends('admin.layout.master')

@section('title', 'Category Edit Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('admin#categorylist') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Category Form</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#editCategory', $category->id) }}" method="post"
                            novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">Name</label>
                                <input id="categoryName" name="categoryName" value="{{ $category->name }}"type="text"
                                    class="form-control @error('categoryName')is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Seafood...">

                                @error('categoryName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    <span id="payment-button-amount">Edit</span>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
