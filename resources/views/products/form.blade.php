@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>{{ ucfirst($type) }} Product</h2>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <script>window.product = @json($product);</script>
    <div id="app">
        <div class="container">
            <product-form>
        
            </product-form>
        </div>
    </div>
</section>

@endsection
