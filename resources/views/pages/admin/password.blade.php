<div class="modal fade" id="pass-{{$user->id}}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Password Untuk {{$user->name}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" method="POST" action="{{route('admin.pass', ['id' => $user->id])}}">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="token" value="{{ session('token') }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Password Baru</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="password" name="password" required>
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