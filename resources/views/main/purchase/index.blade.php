@extends('templates.index')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                {{-- <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">CPU Traffic</span>
                                <span class="info-box-number">
                                    10
                                    <small>%</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sales</span>
                                <span class="info-box-number">760</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">New Members</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div> --}}
                <!-- /.row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col">

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Data Supplier</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btn-light text-primary" id="buttonModal">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <table class="table m-0" id="table-purchase">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
                                                <th width="75px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('modal')
    <!-- Modal Input -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Input Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="InputData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="select2">
                                <option value>== Pilih Supplier ==</option>
                                @foreach ($suppliers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <small class="supplier_id form-text form-text-validation text-danger"></small>
                        </div>
                        <a class="btn btn-sm btn-primary float-right my-3" id="tambahPurchase">Tambah <i class="fas fa-plus"></i></a>
                        <table class="table">
                            <thead>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="EditData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Supplier</label>
                            <input type="text" class="form-control" id="name" name="name"
                                aria-describedby="validation-file">
                            <small class="name form-text form-text-validation text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="name">Alamat Supplier</label>
                            <textarea name="address" id="address" cols="50" rows="30" class="summernote"></textarea>
                            <small class="address form-text form-text-validation text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="address">Telepon Supplier</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                aria-describedby="validation-file">
                            <small class="phone form-text form-text-validation text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Supplier</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="validation-file">
                            <small class="email form-text form-text-validation text-danger"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('style')
    <link href="/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/select2/css/select2.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
    <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.css">
@endpush


@push('scripts')
    <script src="/plugins/summernote/summernote-bs4.js"></script>
    <script src="/plugins/select2/js/select2.full.js"></script>
    <script src="/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="/assets/js/service-helper.js"></script>
    <script src="/assets/js/service-crud.js"></script>

    <script>
        let crud = new Crud();
        let data = {
            colums: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            url: '/api/v1/purchases/get',
            table: 'table-purchase'
        }

        crud.get(data)

        $('#buttonModal').on('click', async function() {
            const result = await crud.getData({
                url: '/api/v1/products/get/all'
            });
            let product = ' '
            result.data.forEach(value => {
                product += `<option value="${value.id}">${value.name}</option>`
            })
            let html = `
                    <tr>
                        <td>
                            <select name="product[]" data-id="1" id="product1" class="select2">
                                <option value>== Pilih Product ==</option>
                                ${product}
                            </select>
                        </td>
                        <td><input class="form-control" type="number" name="qty[]" data-id="1" id="qty1"/></td>
                        <td><input class="form-control" disabled type="text" name="price[]" data-id="1" id="price1"/></td>
                        <td><input class="form-control" disabled type="text" name="amount[]" data-id="1" id="amount1"/></td>
                        <td>Default</td>

                    </tr>
            `
            $('#InputData table tbody').append(html)
            $('#InputData table tbody .select2').select2({
                theme: 'bootstrap4'
            });
            $('#staticBackdrop').modal('show')
        })

        $('form').on('submit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let data = null
            if (id == undefined) {
                data = {
                    data: new FormData(this),
                    url: '/api/v1/purchases/store',
                    validation: true
                }
            } else {
                data = {
                    data: new FormData(this),
                    url: '/api/v1/purchases/update/' + id,
                    validation: true
                }
            }
            crud.input(data);
            crud.reload('table-purchase')
        })

        $('#table-purchase').on('click', '.Delete', async function() {
            let id = $(this).data('id')
            let data = {
                data: id,
                url: '/api/v1/purchases/destroy',
                table: 'table-purchase'
            }
            crud.delete(data)
        })

        $('#table-purchase').on('click', '.Edit', async function() {
            let id = $(this).data('id')
            let data = {
                data: id,
                url: '/api/v1/purchases/edit',
            }
            let response = await crud.edit(data)
            if (response) {
                $('#editModal').modal('show')
                for (const [key, value] of Object.entries(
                        response.data.purchase
                    )) {
                    if (key == 'description' || key == 'address') {
                        $(`#EditData #${key}`).summernote("code", value);
                    } else {
                        $(`#EditData #${key}`).val(value)
                    }
                }
                $('#EditData').data('id', response.data.purchase.id);
            }
        })

        $('#tambahPurchase').on('click', async function() {
            let count = $('#InputData table tbody tr').length + 1;
            const result = await crud.getData({
                url: '/api/v1/products/get/all'
            });
            let product = ' '
            result.data.forEach(value => {
                product += `<option value="${value.id}">${value.name}</option>`
            })
            let html = `
                    <tr id="tr-${count}">
                        <td>
                            <select name="product[]" data-id="${count}" id="product${count}" class="select2">
                                <option value>== Pilih Product ==</option>
                                ${product}
                            </select>
                        </td>
                        <td><input class="form-control" type="number" name="qty[]" data-id="${count}" id="qty${count}"/></td>
                        <td><input class="form-control" disabled type="text" name="price[]" data-id="${count}" id="price${count}"/></td>
                        <td><input class="form-control" disabled type="text" name="amount[]" data-id="${count}" id="amount${count}"/></td>
                        <td><a class="btn btn-sm btn-danger product-delete" data-id="${count}"><i class="fas fa-trash"></i></a></td>
                    </tr>
            `
            $('#InputData table tbody').append(html)
            $('#InputData table tbody .select2').select2({
                theme: 'bootstrap4'
            });
        })

        $('#InputData').on('click', '.product-delete', function() {
            let id = $(this).data('id')
            $('#InputData table #tr-'+id).remove()
        })

        $('.summernote').summernote();

        $('.select2').select2({
            theme: 'bootstrap4'
        });
    </script>
@endpush