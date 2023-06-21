<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            @if (session()->has('e-message'))
            <div class="alert alert-danger" role="alert">
                {{ session('e-message') }}
            </div>
            @endif
            <form wire:submit.prevent="authcheck">
                <div class="mb-3">
                    <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter..." wire:model="email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password<span class="text-danger ms-1">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter..." wire:model="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-end">
                    <div wire:loading wire:target="authcheck" wire:key="authcheck"><i class="fa fa-cog fa-spin me-1"></i>Please
                        wait...</div>
                    <div wire:loading.remove wire:target="authcheck"><i class="fas fa-sign-in-alt me-1"></i>Login</div>
                </button>
            </form>
        </div>
    </div>
</div>