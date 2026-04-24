
    @extends('layouts.auth')

    @section('content')
     <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

      @include('sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

            @include('nav')
        <!-- / Menu -->

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Products List</h4>

        <a href="{{url('define/product')}}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    <div class="card">
        <h5 class="card-header">All Products</h5>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Sale Rate</th>
                        <th>Purchase Rate</th>
                        <th>Roi</th>
                        <th>Category</th>

                        <th width="120">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->barcode }}</td>
                            

                            <td>
                                <strong>{{ $product->name }}</strong>
                            </td>

                            <td>Rs {{ $product->sale_rate }}</td>

                            <td>{{ $product->purchase_rate }}</td>
                            <td>{{ $product->roi }} %</td>
                            <td>{{ $product->category->category_name }}</td>

                           

                            <td>
                                <div class="d-flex gap-2">
                                    
                                    <a href="" 
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="" 
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this product?')">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No products found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

            <!-- / Content -->


            <!-- Footer -->
             @include('footer')
            <!-- / Content -->
            <!-- / Footer -->

           
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @endsection
