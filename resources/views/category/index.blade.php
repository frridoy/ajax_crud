<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h5 {
            font-weight: bold;
            color: #343a40;
        }

        .container {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        table.table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f6fc;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004a9f;
        }

        .mb-3 label {
            font-weight: 500;
            color: #495057;
        }

        .col-lg-4 {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <h5 class="mb-3">Country List</h5>
                <table class="table table-bordered table-striped" id="categoryTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width:70px">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Capital</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-4">
                <h5 class="mb-3">Add Category</h5>
                <form action="{{ route('category.store') }}" method="POST" autocomplete="off" id="category_store">
                    @csrf
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control"
                            placeholder="Enter category name">
                        <span class="text-danger validation-error category_name_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="category_description" class="form-label">Description</label>
                        <input type="text" name="category_description" id="category_description" class="form-control"
                            placeholder="Enter Category Description">
                        <span class="text-danger validation-error category_description_error"></span>
                    </div>
                     <div class="mb-3">
                        <label for="category_description" class="form-label">Status</label>
                       <select name="category_status" id="category_status" class="form-control">
                           <option value="">Select Status</option>
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                       </select>
                        <span class="text-danger validation-error category_status_error"></span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Save</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('form#category_store').submit(function(e) {
            e.preventDefault();
            let form = this;
            let formdata = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $(form).find('span.validation-error').text('');
                },
                success: function(data) {
                    if (data.status == 1) {
                        toastr.success(data.message);
                        form.reset();
                        table.ajax.reload(null, false);
                    }
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(form).find('span.' + key + '_error').text(value);
                    });
                }
                
            });
        });

</script>

</body>
</html>
