
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
                                    
                                   <button class="btn btn-sm btn-warning editBtn"
    data-barcode="{{ $product->barcode }}"
        data-name="{{ $product->name }}"
        data-sale="{{ $product->sale_rate }}"
        data-purchase="{{ $product->purchase_rate }}">
    Edit
</button>

                                    
                                      
<button class="btn btn-sm btn-danger deleteBtn"
            data-barcode="{{ $product->barcode }}"
>
    Delete
</button>
                                  

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

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editProductForm">
        @csrf
        <input type="hidden" id="edit_id">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

           <div class="modal-body">

    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" id="edit_name" class="form-control" placeholder="Enter product name">
    </div>

    <div class="mb-3">
        <label class="form-label">Sale Rate (Rs)</label>
        <input type="number" id="edit_sale_rate" class="form-control" placeholder="Enter sale rate">
    </div>

    <div class="mb-3">
        <label class="form-label">Purchase Rate (Rs)</label>
        <input type="number" id="edit_purchase_rate" class="form-control" placeholder="Enter purchase rate">
    </div>

</div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
  </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Confirm Delete</h5>
        </div>

        <div class="modal-body">
            Are you sure you want to delete this product?
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" id="confirmDelete">Delete</button>
        </div>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
let deleteBarcode = null;

// EDIT BUTTON CLICK
$(document).on('click', '.editBtn', function () {
    $('#edit_id').val($(this).data('barcode')); // now barcode
    $('#edit_name').val($(this).data('name'));
    $('#edit_sale_rate').val($(this).data('sale'));
    $('#edit_purchase_rate').val($(this).data('purchase'));

    $('#editProductModal').modal('show');
});

// UPDATE PRODUCT
$('#editProductForm').submit(function (e) {
    e.preventDefault();

let barcode = $('#edit_id').val();

   $.ajax({
    url: '/products/' + barcode,
    type: 'PUT',
    data: {
        _token: '{{ csrf_token() }}',
        name: $('#edit_name').val(),
        sale_rate: $('#edit_sale_rate').val(),
        purchase_rate: $('#edit_purchase_rate').val(),
    },
    success: function (res) {
        $('#editProductModal').modal('hide');

        showToast('Product updated successfully');

        setTimeout(() => location.reload(), 1200);
    },
    error: function (xhr) {
        if (xhr.responseJSON && xhr.responseJSON.error) {
            showToast(xhr.responseJSON.error);
        } else {
            showToast('Something went wrong');
        }
    }
});

    });


// DELETE BUTTON CLICK
$(document).on('click', '.deleteBtn', function () {
    deleteBarcode = $(this).data('barcode');
    $('#deleteModal').modal('show');
});

// CONFIRM DELETE
$('#confirmDelete').click(function () {
    $.ajax({
        url: '/products/' + deleteBarcode,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function () {
            $('#deleteModal').modal('hide');

           showToast('Product deleted successfully');


setTimeout(() => location.reload(), 1200);

        }
    });
});
</script>


    @endsection
