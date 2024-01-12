@extends('admin.layout.master')

@section('title', 'Category List Page')

@section('content')
    {{-- <!--Add successful Message-->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> --}}


    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                        <!--Update Successful Message -->
                        @if (session('updateSuccess'))
                            <div class="my-4 alert alert-success alert-dismissible fade show d-flex align-items-center col-9 "
                                role="alert">
                                {{ session('updateSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!--Update Successful Message End -->


                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#categoryCreatePage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </a>

                    </div>


                </div>
                <!--Search-->
                <form action="{{ route('admin#categorylist') }}" method="GET">
                    @csrf
                    <div class="d-flex col-3 offset-9">
                        <input class="form-control" type="text" name="searchKey" placeholder=" Search..."
                            value="{{ request('searchKey') }}">
                        <button class="btn btn-dark text-white" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>

                </form>

                @if (count($data) != 0)

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>created date</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at->format('j-M-Y') }}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="View">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button> --}}
                                                <a href="{{ route('admin#categoryEditPage', $item->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('admin#deleteCategory', $item->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>

                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="spacer"></tr>
                                @endforeach
                                {{-- <tr class="tr-shadow">
                                <td>Lori Lynch</td>
                                <td>
                                    <span class="block-email">lori@example.com</span>
                                </td>
                                <td class="desc">Samsung S8 Black</td>
                                <td>2018-09-27 02:12</td>
                                <td>
                                    <span class="status--process">Processed</span>
                                </td>
                                <td>$679.00</td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr> --}}

                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                @else
                    <div class="text-center  px-6">
                        <h3>Data Empty</h3>
                    </div>

                @endif
                <!-- END DATA TABLE -->
            </div>


        </div>





        <!--Delete Successful Message -->
        @if (session('deleteSuccess'))
            <div class="my-4 alert alert-danger alert-dismissible fade show col-4 offset-8" role="alert">
                {{ session('deleteSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!--Delete Successful Message End -->


    </div>

@endsection
