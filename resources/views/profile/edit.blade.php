<x-layout>

<div class="container py-5" style="max-width:700px;">
    <h2 class="mb-4">Il tuo profilo</h2>

    <div class="app-card app-card-hover rounded-4 p-4 p-md-5 mb-4">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="app-card app-card-hover rounded-4 p-4 p-md-5 mb-4">
        @include('profile.partials.update-password-form')
    </div>

    <div class="app-card app-card-hover rounded-4 p-4 p-md-5">
        @include('profile.partials.delete-user-form')
    </div>
</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background:#15151d; border:1px solid #24242e; color:#F8F7FC;">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header" style="border-color:#24242e;">
                    <h5 class="modal-title">Sei sicuro di voler eliminare il tuo account?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p style="color:#8B879E; font-size:14px;">
                        Questa azione è permanente. Inserisci la tua password per confermare.
                    </p>

                    <label class="form-label-custom">Password</label>
                    <input type="password" name="password" class="form-control admin-input" placeholder="Password">
                    @if ($errors->userDeletion->get('password'))
                        <div class="text-danger mt-2" style="font-size:13px;">
                            {{ $errors->userDeletion->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="modal-footer" style="border-color:#24242e;">
                    <button type="button" class="btn btn-outline-dark-custom" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-cancel-custom">Elimina account</button>
                </div>
            </form>
        </div>
    </div>
</div>

</x-layout>