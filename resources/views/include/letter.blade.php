<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Newsletter</h4>
    </div>
    <div class="bg-white text-center border border-top-0 p-3">
            <!-- Affichage des messages flash -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        toastr.success('{{ session('success') }}', 'Succès', {
                            closeButton: true,
                            progressBar: true,
                            positionClass: "toast-top-right",
                            timeOut: 5000
                        });
                    });
                </script>
            @endif
            <p>Inscrivez-vous à notre newsletter pour ne rien manquer sur le sport ivoirien et international.</p>
            <div class="input-group mb-2" style="width: 100%;">
            <form action="{{ route('NewsLetter.store') }}" method="post">
                @csrf
                <input type="email" name="mail" class="form-control form-control-lg" placeholder="Votre E-mail">
                <div class="input-group-append">
                    <button class="btn btn-primary font-weight-bold px-3">inscription</button>
                </div>

            </form>
        </div>
        <small>................................</small>
    </div>
</div>
