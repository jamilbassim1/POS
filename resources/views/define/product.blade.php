
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

            <!-- / Content -->
<div class="container-xxl flex-grow-1 container-p-y">

 <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">Create Product</h4>

        <a href="{{ route('products.index') }}" class="btn btn-primary">
            See Products
        </a>
    </div>    

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('products.store') }}" id="productForm"
>
                @csrf

                <div class="row g-3">

                    <!-- Product Name -->
                    <div class="col-md-6">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- Category -->
                  <div class="col-md-6">
    <label class="form-label">Category</label>

    <div class="input-group">
        <select id="category_id" name="category_id" class="form-select">
            <option value="">Select Category</option>
        </select>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
            +
        </button>
    </div>
</div>

                      <!-- Company -->
         <div class="col-md-6">
    <label class="form-label">Company</label>

    <div class="input-group">
       <select id="company_id" name="company_id" class="form-select">
    <option value="">Select Company</option>
</select>

        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#companyModal">
            +
        </button>
    </div>
</div>


                    <!-- Summary -->
                  

                    <!-- Location -->
                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control">
                    </div>

                    <!-- Purchase Rate -->
                    <div class="col-md-6">
                        <label class="form-label">Purchase Rate</label>
                        <input type="number" id="purchase_rate" name="purchase_rate" class="form-control">
                    </div>

                    <!-- Sale Rate -->
                    <div class="col-md-6">
                        <label class="form-label">Sale Rate</label>
                        <input type="number" id="sale_rate" name="sale_rate" class="form-control">
                    </div>

                    <!-- ROI (auto calculated) -->
                    <div class="col-md-6">
                        <label class="form-label">ROI (%)</label>
                        <input type="text" id="roi" name="roi" class="form-control" readonly>
                    </div>

                     <div class="col-md-6">
                        <label class="form-label">Whole Sale Rate</label>
                        <input type="number" id="whole_sale_rate" name="whole_sale_rate" class="form-control" >
                    </div>

                    <!-- ASIN (auto generated) -->
                    <div class="col-md-6">
                        <label class="form-label">ASIN Number</label>
                        <input type="text" id="asin" name="asin" class="form-control" readonly>
                    </div>

                    <!-- Barcode (auto generated) -->
                    <div class="col-md-6">
                        <label class="form-label">Barcode</label>
                        <input type="text" id="barcode" name="barcode" class="form-control" readonly>
                    </div>

                      <div class="col-12">
                        <label class="form-label">Summary</label>
                        <textarea name="summary" class="form-control" rows="3"></textarea>
                    </div>

                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Save Product</button>
                </div>

            </form>

        </div>
    </div>

    <div class="modal fade" id="categoryModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="text" id="new_category" class="form-control" placeholder="Category name">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
      </div>

    </div>
  </div>
</div>




<div class="modal fade" id="companyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Company</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="text" id="new_company" class="form-control" placeholder="Company Name">
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" id="saveCompany">Save</button>
      </div>

    </div>
  </div>
</div>












</div>
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
<script>
$(document).ready(function () {

    // ========================
    // LOAD CATEGORIES
    // ========================
    loadCategories();

    function loadCategories() {
        $.get("/categories/list", function (data) {
            $('#category_id').html('<option value="">Select Category</option>');
            data.forEach(function (cat) {
                $('#category_id').append(
                    `<option value="${cat.id}">${cat.category_name}</option>`
                );
            });
        });
    }

    // ========================
    // SAVE CATEGORY
    // ========================
    $('#saveCategory').click(function () {

        let name = $('#new_category').val();

        if (!name) {
            alert('Enter category name');
            return;
        }

        $.ajax({
            url: "/categories/store",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                category_name: name
            },
            success: function () {

                $('#new_category').val('');

                let modal = bootstrap.Modal.getInstance(document.getElementById('categoryModal'));
                modal.hide();

                loadCategories();
            }
        });

    });

    // ========================
    // LOAD COMPANIES
    // ========================
    loadCompanies();

    function loadCompanies() {
        $.get("/companies/list", function (data) {
            $('#company_id').html('<option value="">Select Company</option>');
            data.forEach(function (comp) {
                $('#company_id').append(
                    `<option value="${comp.id}">${comp.company_name}</option>`
                );
            });
        });
    }

    // ========================
    // SAVE COMPANY
    // ========================
    $('#saveCompany').click(function () {

    let name = $('#new_company').val();

    if (!name) {
        alert('Enter company name');
        return;
    }

    $.ajax({
        url: "/companies/store",
        method: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            company_name: name   // ✅ FIXED
        },
        success: function () {

            $('#new_company').val('');

            let modal = bootstrap.Modal.getInstance(document.getElementById('companyModal'));
            modal.hide();

            loadCompanies();
        }
    });

});


});
</script>
<script>
function generateASIN() {
    return 'AS' + Math.random().toString(36).substring(1, 10).toUpperCase();
}

function generateBarcode() {
    return Date.now().toString().slice(-12);
}

function calculateROI() {
    let purchase = parseFloat(document.getElementById('purchase_rate').value || 0);
    let sale = parseFloat(document.getElementById('sale_rate').value || 0);

    if (purchase > 0) {
        let roi = ((sale - purchase) / purchase) * 100;
        document.getElementById('roi').value = roi.toFixed(1) + '%';
    }
}

document.getElementById('purchase_rate').addEventListener('input', calculateROI);
document.getElementById('sale_rate').addEventListener('input', calculateROI);

// auto generate on load
window.onload = function () {
    document.getElementById('asin').value = generateASIN();
    document.getElementById('barcode').value = generateBarcode();
};
</script>

<script>
         $('#productForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: "{{ route('products.store') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function (res) {

            showToast(res.message || "Product created successfully", "success");

            $('#productForm')[0].reset();
             document.getElementById('asin').value = generateASIN();
            document.getElementById('barcode').value = generateBarcode();
        },
      error: function (xhr) {

    let msg = "Something went wrong";

    if (xhr.responseJSON) {

        // 1. validation errors (Laravel Validator)
        if (xhr.responseJSON.message && typeof xhr.responseJSON.message === "object") {
            msg = Object.values(xhr.responseJSON.message)[0][0];
        }

        // 2. normal message
        else if (xhr.responseJSON.message) {
            msg = xhr.responseJSON.message;
        }

        // 3. simple error key
        else if (xhr.responseJSON.error) {
            msg = xhr.responseJSON.error;
        }
    }

    showToast(msg, "danger");
}

    });
});

</script>

    @endsection
