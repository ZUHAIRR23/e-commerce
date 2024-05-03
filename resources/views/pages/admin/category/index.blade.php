@extends('layouts.parent')

@section('title', 'Category')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Category</h5>


            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Data Category</li>
                </ol>
            </nav>

            {{-- Button Modal Create Category --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModalCategory">
                <div class="bi bi-plus">Add Category</div>
            </button>
            @include('pages.admin.category.modal-create')

            {{-- Table with stripped rows --}}
            <table class="table datatable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Image</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $row)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <th>{{ $row->name }}</th>
                            <th>
                                <img src="{{ url('storage/category/', $row->image) }}" alt="{{ $row->name }}" class="w-25">
                            </th>
                            <th>
                                <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#editModalCategory{{ $row->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @include('pages.admin.category.modal-edit')
                                <form action="{{ route('admin.category.destroy', $row->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Data Is Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript">
        ;

        (function($) {
            function readURL(input) {
                var $prev = $('preview-logo')

                if (input.files && input.files[0]) {
                    var reader = new fileReader();

                    reader.onload = function(e) {
                        $prev.attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                    $prev.attr('class', '')

                } else {
                    $prev.attr('class', 'visually-hidden')
                }
            }

            $('#image').on('change', function() {
                readURL(this);
            });
        })(jQuery);
    </script>
@endpush
