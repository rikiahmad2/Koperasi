@extends('layouts.apppegawai', ['title' => 'Nasabah'])

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
                        <h1>Manage Nasabah</h1>
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
                            <h3 class="card-title">Data Nasabah</h3>
                            <div class="d-flex flex-row-reverse">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fas fa-plus"></i>
                                    Tambah Nasabah
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Nasabah</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.tambahNasabah') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">No Identitas</label>
                                                <input type="number" class="form-control" name="noidentitas" id="nip2"
                                                    placeholder="NIP" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="name" id="name2"
                                                    placeholder="Nama" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">TTL</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="ttl" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin2">
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Agama</label>
                                                <input type="text" class="form-control" name="agama" id="agama2"
                                                    placeholder="Agama" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Pekerjaan</label>
                                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan2"
                                                    placeholder="Pekerjaan" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Pendidikan</label>
                                                <input type="text" class="form-control" name="pendidikan" id="pendidikan2"
                                                    placeholder="Pendidikan" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Nomor Hp</label>
                                                <input type="number" class="form-control" name="no_hp" id="no_hp2"
                                                    placeholder="Nomor Hp" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Alamat</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Kelurahan</label>
                                                <input type="text" class="form-control" name="kelurahan" id="kelurahan2"
                                                    placeholder="Kelurahan" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Kecamatan</label>
                                                <input type="text" class="form-control" name="kecamatan" id="kecamatan2"
                                                    placeholder="Kecamatan" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Provinsi</label>
                                                <input type="text" class="form-control" name="provinsi" id="provinsi2"
                                                    placeholder="Provinsi" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Pengelola</label>
                                                <select class="form-control" name="user_id" id="user_id2">
                                                    @foreach ($pengelola as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
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
                                        <th>No Identitas</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Pekerjaan</th>
                                        <th>Pendidikan</th>
                                        <th>Nomor Hp</th>
                                        <th>Pengelola</th>
                                        <th>Alamat</th>
                                        <th>TTL</th>
                                        <th>Kelurahan</th>
                                        <th>Kecamatan</th>
                                        <th>Provinsi</th>
                                        <th>Tgl Buat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->noidentitas }}</td>
                                            <td>{{ $row->name }}
                                            </td>
                                            <td>{{ $row->jenis_kelamin }}</td>
                                            <td>{{ $row->pekerjaan }}</td>
                                            <td>{{ $row->pendidikan }}</td>
                                            <td>{{ $row->no_hp }}</td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->ttl }}</td>
                                            <td>{{ $row->kelurahan }}</td>
                                            <td>{{ $row->kecamatan }}</td>
                                            <td>{{ $row->provinsi }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" data-id_nasabah="{{ $row->id_nasabah }}" data-agama="{{ $row->agama }}"
                                                    data-noidentitas="{{ $row->noidentitas }}" data-name="{{ $row->name }}" data-jenis_kelamin="{{ $row->jenis_kelamin }}"
                                                    data-pekerjaan="{{ $row->pekerjaan }}" data-pendidikan="{{$row->pendidikan}}" data-no_hp="{{$row->no_hp}}" data-pengelola="{{$row->user->id}}"
                                                    data-alamat="{{ $row->alamat }}" data-ttl="{{ $row->ttl }}" data-kelurahan="{{ $row->kelurahan }}" data-kecamatan="{{ $row->kecamatan }}"
                                                    data-provinsi="{{ $row->provinsi }}"
                                                    class="open-AddBookDialog btn btn-warning" data-toggle="modal"
                                                    data-target="#exampleModalEdit">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="delete-AddBookDialog btn btn-danger"
                                                    data-id2="{{ $row->id_nasabah }}" data-name="{{ $row->name }}"
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
                                    <h5 class="modal-title" id="exampleModalEdit">Edit Nasabah</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.editNasabah') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">No Identitas</label>
                                            <input type="number" class="form-control" name="noidentitas" id="noidentitas"
                                                placeholder="Nomor Identitas" required />
                                            <input type="hidden" class="form-control" name="id_nasabah" id="id_nasabah"
                                                placeholder="id_nasabah" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Nama" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">TTL</label>
                                            <textarea class="form-control" id="ttl" name="ttl" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Agama</label>
                                            <input type="text" class="form-control" name="agama" id="agama"
                                                placeholder="Agama" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"
                                                placeholder="Pekerjaan" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Pendidikan</label>
                                            <input type="text" class="form-control" name="pendidikan" id="pendidikan"
                                                placeholder="Pendidikan" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Nomor Hp</label>
                                            <input type="number" class="form-control" name="no_hp" id="no_hp"
                                                placeholder="Nomor Hp" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Kelurahan</label>
                                            <input type="text" class="form-control" name="kelurahan" id="kelurahan"
                                                placeholder="Kelurahan" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Kecamatan</label>
                                            <input type="text" class="form-control" name="kecamatan" id="kecamatan"
                                                placeholder="Kecamatan" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Provinsi</label>
                                            <input type="text" class="form-control" name="provinsi" id="provinsi"
                                                placeholder="Provinsi" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Pengelola</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                @foreach ($pengelola as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
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
            var id_nasabah = $(this).data('id_nasabah');
            var noidentitas = $(this).data('noidentitas');
            var name = $(this).data('name');
            var ttl = $(this).data('ttl');
            var jenis_kelamin = $(this).data('jenis_kelamin');
            var agama = $(this).data('agama');
            var pekerjaan = $(this).data('pekerjaan');
            var pendidikan = $(this).data('pendidikan');
            var no_hp = $(this).data('no_hp');
            var alamat = $(this).data('alamat');
            var kelurahan = $(this).data('kelurahan');
            var kecamatan = $(this).data('kecamatan');
            var provinsi = $(this).data('provinsi');
            var pengelola = $(this).data('pengelola');
            

            $(".modal-body #id_nasabah").val(id_nasabah);
            $(".modal-body #noidentitas").val(noidentitas);
            $(".modal-body #name").val(name);
            $(".modal-body #ttl").val(ttl);
            $(".modal-body #jenis_kelamin").val(jenis_kelamin);
            $(".modal-body #agama").val(agama);
            $(".modal-body #pekerjaan").val(pekerjaan);
            $(".modal-body #pendidikan").val(pendidikan);
            $(".modal-body #no_hp").val(no_hp);
            $(".modal-body #alamat").val(alamat);
            $(".modal-body #kelurahan").val(kelurahan);
            $(".modal-body #kecamatan").val(kecamatan);
            $(".modal-body #provinsi").val(provinsi);
            $(".modal-body #pengelola").val(pengelola);
        });

        //MODAL 2
        $(document).on("click", ".delete-AddBookDialog", function() {
            var id = $(this).data('id2');
            var name = $(this).data('name');
            var url = "{{ url('/delete-nasabah') }}";

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
