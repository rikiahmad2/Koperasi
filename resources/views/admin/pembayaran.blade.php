@extends('layouts.app', ['title' => 'Dashboard'])

@section('headassets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Pembayaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="nav-icon fas fa-money-bill-wave"></i> Data Pembayaran</h3>
                            <div class="d-flex flex-row-reverse">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>
                                    Tambah Pembayaran
                                </button>
                            </div>
                            <div class="d-flex flex-row-reverse" style="padding-top: 5px">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalPrint">
                                    <i class="fas fa-print"></i>
                                    Print Laporan
                                </button>
                            </div>
                        </div>

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.tambahPembayaran') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Kode Pembiayaan</label>
                                                <input type="number" class="form-control" name="id_pembiayaan" id="id_pembiayaan2"
                                                    placeholder="Kode Pembiayaan" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nama Penyetor</label>
                                                <input type="text" class="form-control" name="nama_penyetor" id="nama_penyetor2"
                                                    placeholder="Nama Penyetor" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Angsuran Bulan</label>
                                                <input type="text" class="form-control" name="angsuran_bulan" id="angsuran_bulan2"
                                                    placeholder="Angsuran Bulan" required />
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Print -->
                        <div class="modal fade" id="exampleModalPrint" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Print Laporan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.laporanPembayaran') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Kode Pembiayaan</label>
                                                <input type="number" class="form-control" name="id_pembiayaan" id="id_pembiayaan2"
                                                    placeholder="Kode Pembiayaan" required />
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Pembayaran</th>
                                        <th>Kode Pembiayaan</th>
                                        <th>Nomor Rekening</th>
                                        <th>Nama Nasabah</th>
                                        <th>Nama Penyetor</th>
                                        <th>Angsuran Ke</th>
                                        <th>Angsuran Bulan</th>
                                        <th>Total Bayar</th>
                                        <th>Tanggal bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;?>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id_pembayaran }}</td>
                                            <td>{{ $row->pembiayaan->id_pembiayaan }}</td>
                                            <td>{{ $row->pembiayaan->no_rekening }}</td>
                                            <td>{{ $row->pembiayaan->nasabah->name }}</td>
                                            <td>{{ $row->nama_penyetor }}</td>
                                            <td>{{ $row->angsuran_ke }}</td>
                                            <td>{{ $row->angsuran_bulan }}</td>
                                            <td>@currency($row->total_bayar)</td>
                                            <td>{{$row->created_at}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button"
                                                    data-id_pembayaran="{{ $row->id_pembayaran }}" data-id_pembiayaan="{{$row->id_pembiayaan}}"
                                                    data-nama_penyetor="{{ $row->nama_penyetor }}" data-angsuran_bulan="{{$row->angsuran_bulan}}"
                                                    class="open-AddBookDialog btn btn-warning" data-toggle="modal"
                                                    data-target="#exampleModalEdit">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="delete-AddBookDialog btn btn-danger"
                                                    data-id_pembayaran="{{ $row->id_pembayaran }}" data-id_pembiayaan="{{$row->id_pembiayaan}}"
                                                    data-toggle="modal" data-target="#exampleModalDelete">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Button trigger modal -->
                                                <a href="{{route('admin.viewPembayaran', ["id" => $row->id_pembayaran])}}" class="btn btn-primary" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabelDelete" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabelDelete">
                                                Yakin untuk menghapus ini?
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="button" class="btn btn-danger" id="delete">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                        <div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalEdit" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalEdit">Edit Akun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.editPembayaran') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Kode Pembiayaan</label>
                                            <input type="number" class="form-control" name="id_pembiayaan" id="id_pembiayaan"
                                                placeholder="Kode Pembiayaan" required />
                                            <input type="hidden" class="form-control" name="id_pembayaran" id="id_pembayaran"
                                                placeholder="Kode Pembiayaan" required />                                               
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nama Penyetor</label>
                                            <input type="text" class="form-control" name="nama_penyetor" id="nama_penyetor"
                                                placeholder="Nama Penyetor" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Angsuran Bulan</label>
                                            <input type="text" class="form-control" name="angsuran_bulan" id="angsuran_bulan"
                                                placeholder="Angsuran Bulan" required />
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('jscript')
    <!-- DataTables -->
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(document).on("click", ".open-AddBookDialog", function() {
            var id_pembiayaan = $(this).data('id_pembiayaan');
            var id_pembayaran = $(this).data('id_pembayaran');
            var nama_penyetor = $(this).data('nama_penyetor');
            var angsuran_bulan = $(this).data('angsuran_bulan');

            $(".modal-body #id_pembiayaan").val(id_pembiayaan);
            $(".modal-body #id_pembayaran").val(id_pembayaran);
            $(".modal-body #nama_penyetor").val(nama_penyetor);
            $(".modal-body #angsuran_bulan").val(angsuran_bulan);
        });

        //MODAL 2
        $(document).on("click", ".delete-AddBookDialog", function() {
            var id_pembayaran = $(this).data('id_pembayaran');
            var id_pembiayaan = $(this).data('id_pembiayaan');
            var url = "{{ url('/delete-pembayaran') }}";

            $("#exampleModalLabelDelete").text("Menghapus Pembayaran "+ id_pembayaran + " ?");
            $("#delete").click(function() {
                window.location.replace(url + '/' + id_pembayaran + '/'+ id_pembiayaan);
            });
        });
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('tambah'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Data Di Tambah',
                    text: 'Data Berhasil Di Tambah',
                    icon: 'success',
                    confirmButtonText: 'Mengerti'
                })
            });
        </script>
    @endif
    @if (session('delete'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Data Dihapus',
                    text: 'Data Berhasil Dihapus',
                    icon: 'success',
                    confirmButtonText: 'Mengerti'
                })
            });
        </script>
    @endif
    @if (session('edit'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Data Di Edit',
                    text: 'Data Berhasil Di Edit',
                    icon: 'success',
                    confirmButtonText: 'Mengerti'
                })
            });
        </script>
    @endif
    @if (session('gagal'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Id Tidak Valid',
                    text: 'Id Pembiayaan Tidak Ditemukan',
                    icon: 'error',
                    confirmButtonText: 'Mengerti'
                })
            });
        </script>
    @endif
@endsection
