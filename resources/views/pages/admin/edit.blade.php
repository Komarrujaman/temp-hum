<div class="modal fade" id="edit-{{$user->id}}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User {{$user->name}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" method="POST" action="{{route('admin.edit', ['id' => $user->id])}}">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="token" value="{{ session('token') }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <select name="roles" id="roles" class="form-control" required>
                                <option value="1" {{ $user->roles == 1 ? 'selected' : '' }}>Administrator</option>
                                <option value="2" {{ $user->roles == 2 ? 'selected' : '' }}>Engineer</option>
                                <option value="3" {{ $user->roles == 3 ? 'selected' : '' }}>Operator</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>