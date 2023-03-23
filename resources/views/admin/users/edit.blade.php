@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'Edit User')

@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit user</h3>
            </div>
            <!-- form start -->
            <form id="form-reset">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter user name"
                            value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email"
                            value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover Photo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cover" value="{{ $user->cover }}">
                                <label class="custom-file-label" for="cover">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" onclick="updateItem('/admin/users/'+{{ $user->id }})"
                        class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function updateItem(url) {
            let formatDate = new FormData();
            formatDate.append('_method', 'put');
            formatDate.append('name', document.getElementById('name').value);
            formatDate.append('email', document.getElementById('email').value);
            formatDate.append('password', document.getElementById('password').value);
            if (document.getElementById('cover').files[0] !== undefined) {
                formatDate.append('cover', document.getElementById('cover').files[0]);
            }

            axios.post(url, formatDate)
                .then(function(response) {
                    console.log(response.data.message);
                    toastr.success(response.data.message);
                    document.getElementById('form-reset').reset();
                    window.location.href = '/admin/users';
                })
                .catch(function(error) {
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message)
                });
        }
    </script>
@endsection
