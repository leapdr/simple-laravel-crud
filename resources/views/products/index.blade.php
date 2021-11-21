@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2>Products</h2>
        </div>
        <div class="col-sm-6">
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <script>window.search = "{{ $search ?? '' }}";</script>
    <script>window.filter = "{{ $filter ?? '' }}";</script>
    
    <div class="container">
        <div class="row mb-4">
            <div class="col-sm-6">
                <select id="filter-products" class="custom-select">
                    <option value='' selected>Select Category</option>
                    @isset ($categories)
                        @foreach ( $categories as $cat)
                            <option value="{{ $cat }}"
                                @if ( $cat == ($filter ?? ''))
                                    selected
                                @endif>
                                {{ $cat }}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right">
                <a href="{{ url('product/new') }}" class="btn btn-block btn-success">Create Product</a>
                </div>
            </div>
        </div><!-- /.row -->

        <div id="app">
            <products>
        
            </products>
        </div>
    </div>
</section>
@endsection
