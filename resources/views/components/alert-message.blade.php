
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100 position-absolute top-0 left-0 z-3">
    <div class="toast align-items-center text-bg-{{ $type }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ $message }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        @if (Session::has('alert-message'))
            $(document).ready(function() {
                $('.toast').toast('show');
            });
        @endif
    </script>
@endpush