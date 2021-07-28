@extends('layouts.app', ['title' => 'Pembiayaan'])

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
                        <h1>Manage Pembiayaan</h1>
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
                            <h3 class="card-title"><i class="nav-icon fas fa-dollar-sign"></i> Data Pembiayaan</h3>
                            <div class="d-flex flex-row-reverse">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>
                                    Tambah Pembiayaan
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pembiayaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.tambahPembiayaan') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nomor Rekening</label>
                                                <input type="number" class="form-control" name="no_rekening" id="no_rekening2"
                                                    placeholder="Nomor Rekening" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Total Pinjaman</label>
                                                <input type="number" class="form-control" name="total_pinjaman" id="total_pinjaman2"
                                                    placeholder="Total Pinjaman" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Jumlah Angsuran</label>
                                                <input type="number" class="form-control" name="jumlah_angsuran" id="jumlah_angsuran2"
                                                    placeholder="Jumlah Angsuran" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Margin Keuntungan/Bulan</label>
                                                <input type="text" class="form-control" name="margin_keuntungan" id="margin_keuntungan2"
                                                    placeholder="Margin Dalam %" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Nasabah Penerima</label>
                                                <select class="form-control" name="id_nasabah" id="id_nasabah2">
                                                    @foreach ($nasabah as $row)
                                                        <option value="{{$row->id_nasabah}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
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
                                        <th>Kode Pembiayaan</th>
                                        <th>Nomor Rekening</th>
                                        <th>Nasabah</th>
                                        <th>Total Pinjaman</th>
                                        <th>Jumlah Angsuran</th>
                                        <th>Margin Keuntungan</th>
                                        <th>Sisa Angsuran</th>
                                        <th>Cicilan Perbulan</th>
                                        <th>Sisa Cicilan</th>
                                        <th>Penanggung Jawab</th>
                                        <th>NIP Pegawai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;?>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id_pembiayaan }}</td>
                                            <td>{{ $row->no_rekening }}</td>
                                            <td>{{ $row->nasabah->name }}</td>
                                            <td>@currency($row->total_pinjaman)</td>
                                            <td>{{ $row->jumlah_angsuran }}</td>
                                            <td>{{ $row->margin_keuntungan }}%</td>
                                            <td>{{ $row->sisa_angsuran }}</td>
                                            <td>@currency($row->cicilan_perbulan)</td>
                                            <td>@currency($row->sisa_cicilan)</td>
                                            <td>{{$row->nasabah->user->name}}</td>
                                            <td>{{$row->nasabah->user->nip}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" data-id_pembiayaan="{{ $row->id_pembiayaan }}"
                                                    data-no_rekening="{{ $row->no_rekening }}" data-total_pinjaman="{{ $row->total_pinjaman }}" data-jumlah_angsuran="{{ $row->jumlah_angsuran }}"
                                                    data-margin_keuntungan="{{ $row->margin_keuntungan }}" data-id_nasabah="{{ $row->id_nasabah }}" data-sisa_angsuran="{{$row->sisa_angsuran}}"
                                                    class="open-AddBookDialog btn btn-warning" data-toggle="modal"
                                                    data-target="#exampleModalEdit">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="delete-AddBookDialog btn btn-danger"
                                                    data-id_pembiayaan="{{ $row->id_pembiayaan }}" data-name="{{ $row->nasabah->name }}"
                                                    data-toggle="modal" data-target="#exampleModalDelete">
                                                    <i class="fas fa-trash"></i>
                                                </button>

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
                                    <form action="{{ route('admin.editPembiayaan') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nomor Rekening</label>
                                            <input type="number" class="form-control" name="no_rekening" id="no_rekening"
                                                placeholder="Nomor Rekening" required />
                                            <input type="hidden" class="form-control" name="id_pembiayaan" id="id_pembiayaan"
                                                placeholder="Nomor Rekening" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Total Pinjaman</label>
                                            <input type="number" class="form-control" name="total_pinjaman" id="total_pinjaman"
                                                placeholder="Total Pinjaman" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jumlah Angsuran</label>
                                            <input type="number" class="form-control" name="jumlah_angsuran" id="jumlah_angsuran"
                                                placeholder="Jumlah Angsuran" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Sisa Angsuran</label>
                                            <input type="number" class="form-control" name="sisa_angsuran" id="sisa_angsuran"
                                                placeholder="Jumlah Angsuran" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Margin Keuntungan/Bulan</label>
                                            <input type="text" class="form-control" name="margin_keuntungan" id="margin_keuntungan"
                                                placeholder="Margin Dalam %" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Nasabah Penerima</label>
                                            <select class="form-control" name="id_nasabah" id="id_nasabah">
                                                @foreach ($nasabah as $row)
                                                    <option value="{{$row->id_nasabah}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
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
            var no_rekening = $(this).data('no_rekening');
            var total_pinjaman = $(this).data('total_pinjaman');
            var jumlah_angsuran = $(this).data('jumlah_angsuran');
            var sisa_angsuran = $(this).data('sisa_angsuran');
            var margin_keuntungan = $(this).data('margin_keuntungan');
            var id_nasabah = $(this).data('id_nasabah');

            $(".modal-body #id_pembiayaan").val(id_pembiayaan);
            $(".modal-body #no_rekening").val(no_rekening);
            $(".modal-body #total_pinjaman").val(total_pinjaman);
            $(".modal-body #jumlah_angsuran").val(jumlah_angsuran);
            $(".modal-body #sisa_angsuran").val(sisa_angsuran);
            $(".modal-body #margin_keuntungan").val(margin_keuntungan);
            $(".modal-body #id_nasabah").val(id_nasabah);
        });

        //MODAL 2
        $(document).on("click", ".delete-AddBookDialog", function() {
            var id_pembiayaan = $(this).data('id_pembiayaan');
            var name = $(this).data('name');
            var url = "{{ url('/delete-pembiayan') }}";

            $("#exampleModalLabelDelete").text("Menghapus "+ name + "?");
            $("#delete").click(function() {
                window.location.replace(url + '/' + id_pembiayaan);
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
@endsection
