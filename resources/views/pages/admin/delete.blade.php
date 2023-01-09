<div class="modal fade" id="delete-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Anda yakin ingin menghapus {{$user->name}}?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action=" {{ route ('admin.delete', ['id' => $user->id ] )}}" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <input type="hidden" name="token" value="{{ session('token') }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </form>

        </div>
    </div>
</div>