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
            <div class="float-sm-right">
            <a href="{{ url('page') }}" class="btn btn-block btn-success">Create Product</a>
            </div>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div id="app">
        <div class="container">
            <products>
        
            </products>
        </div>
    </div>
</section>
@endsection
