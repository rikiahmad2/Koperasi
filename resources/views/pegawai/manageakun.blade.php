@extends('layouts.apppegawai', ['title' => 'Akun'])

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
                        <h1>Manage Akun</h1>
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
                            <h3 class="card-title">Data Akun</h3>
                            <div class="d-flex flex-row-reverse">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>
                                    Tambah Akun
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.tambahAkun') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">NIP (Nomor Induk Pegawai)</label>
                                                <input type="number" class="form-control" name="nip" id="nip2"
                                                    placeholder="NIP" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="name" id="name2"
                                                    placeholder="Nama" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Email</label>
                                                <input type="email" class="form-control" name="email" id="email2"
                                                    placeholder="Nama" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" id="alamat2"
                                                    placeholder="alamat" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin2">
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Level Akun</label>
                                                <select class="form-control" name="level" id="level2">
                                                    <option value="manager">Manager</option>
                                                    <option value="pegawai">Pegawai</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Password</label>
                                                <input type="password" class="form-control" name="password" id="password2"
                                                    placeholder="Password" autocomplete="new-password" required />
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
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Level Akun</th>
                                        <th>Tgl Buat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $row)
                                        <tr>
                                            <td>{{ $row->nip }}</td>
                                            <td>{{ $row->name }}
                                            </td>
                                            <td>{{ $row->jenis_kelamin }}</td>
                                            <td>{{ $row->level }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" data-id="{{ $row->id }}"
                                                    data-name="{{ $row->name }}" data-nip="{{ $row->nip }}" data-jenis_kelamin="{{ $row->jenis_kelamin }}"
                                                    data-level="{{ $row->level }}" data-email="{{$row->email}}" data-alamat="{{$row->alamat}}" data-password="{{$row->password}}"
                                                    class="open-AddBookDialog btn btn-warning" data-toggle="modal"
                                                    data-target="#exampleModalEdit">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="delete-AddBookDialog btn btn-danger"
                                                    data-id2="{{ $row->id }}" data-name="{{ $row->name }}"
                                                    data-toggle="modal" data-target="#exampleModalDelete">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </td>
                                        </tr>
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
                                    <form action="{{ route('admin.editAkun') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">NIP (Nomor Induk Pegawai)</label>
                                            <input type="number" class="form-control" name="nip" id="nip"
                                                placeholder="NIP" required />
                                            <input type="hidden" class="form-control" name="id" id="id"
                                                placeholder="Id" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Nama" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Nama" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" id="alamat"
                                                placeholder="alamat" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Level Akun</label>
                                            <select class="form-control" name="level" id="level">
                                                <option value="manager">Manager</option>
                                                <option value="pegawai">Pegawai</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" autocomplete="new-password" />
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
            var id = $(this).data('id');
            var name = $(this).data('name');
            var nip = $(this).data('nip');
            var level = $(this).data('level');
            var email = $(this).data('email');
            var alamat = $(this).data('alamat');
            var jenis_kelamin = $(this).data('jenis_kelamin');

            $(".modal-body #id").val(id);
            $(".modal-body #name").val(name);
            $(".modal-body #nip").val(nip);
            $(".modal-body #level").val(level);
            $(".modal-body #email").val(email);
            $(".modal-body #jenis_kelamin").val(jenis_kelamin);
            $(".modal-body #alamat").val(alamat);
        });

        //MODAL 2
        $(document).on("click", ".delete-AddBookDialog", function() {
            var id = $(this).data('id2');
            var name = $(this).data('name');
            var url = "{{ url('/delete-akun') }}";

            $("#exampleModalLabelDelete").text("Menghapus "+ name + "?");
            $("#delete").click(function() {
                window.location.replace(url + '/' + id);
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
