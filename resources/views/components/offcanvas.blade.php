<div class="offcanvas offcanvas-end @if ($errors->any() && !session()->has('failures') && !$errors->has('file')) show @endif" tabindex="-1" id="{{ $id }}">
    <div class="offcanvas-header">
        <h5 id="{{ $id }}Label" class="offcanvas-title">{{ $title }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
        {{ $slot }}
    </div>
</div>
