<!DOCTYPE html>
<html>

<head>
    <title>CRUD KILAU</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <div class="container">
        <br>
        <h1>CRUD KILAU</h1>
        <br>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewPost"> Add Post</a>
        <br>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>sumber_dana</th>
                    <th>program</th>
                    <th>keterangan</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="postForm" name="postForm" class="form-horizontal">
                        <input type="hidden" name="post_id" id="post_id">
                        <div class="form-group">
                            <label for="sumber_dana" class="col-sm-2 control-label">sumber_dana</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="sumber_dana" name="sumber_dana"
                                    placeholder="masukan sumber dana" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="program" class="col-sm-2 control-label">program</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="program" name="program"
                                    placeholder="masukan program" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-sm-2 control-label">keterangan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="keterangan" name="keterangan"
                                    placeholder="masukan keterangan" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function() {
        // Header Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //    Render Data Table
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('posts.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'sumber_dana',
                    name: 'sumber_dana'
                },
                {
                    data: 'program',
                    name: 'program'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        // Tombol Add
        $('#createNewPost').click(function() {
            $('#saveBtn').val("create-post");
            $('#post_id').val('');
            $('#postForm').trigger("reset");
            $('#modelHeading').html("Create New Post");
            $('#ajaxModel').modal('show');
        });


        $('body').on('click', '.editPost', function() {
            var post_id = $(this).data('id');
            $.get("{{ route('posts.index') }}" + '/' + post_id + '/edit', function(
                data) {
                $('#modelHeading').html("Edit Post");
                $('#saveBtn').val("edit-post");
                $('#ajaxModel').modal('show');
                $('#post_id').val(data.id);
                $('#sumber_dana').val(data.sumber_dana);
                $('#program').val(data.program);
                $('#keterangan').val(data.keterangan);
            })
        });
        // Tambah Data
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Save Changes');
            $.ajax({
                data: $('#postForm').serialize(),
                url: "{{ route('posts.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#postForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });
        // Hapus Data
        $('body').on('click', '.deletePost', function() {
            var post_id = $(this).data("id");
            $.ajax({
                type: "DELETE",
                url: "{{ route('posts.store') }}" + '/' + post_id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>

</html>
