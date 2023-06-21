<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                    <select class="form-select @error('utype') is-invalid @enderror" wire:model="utype">
                        <option value="" selected>--</option>
                        <option value="1">Customer</option>
                        <option value="0">Banker</option>
                    </select>
                    @error('utype')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter..." wire:model="name">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
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
                <div class="mb-3">
                    <label class="form-label">Confirm Password<span class="text-danger ms-1">*</span></label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter..." wire:model="password_confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-end">
                    <div wire:loading wire:target="store" wire:key="store"><i class="fa fa-cog fa-spin me-1"></i>Please
                        wait...</div>
                    <div wire:loading.remove wire:target="store"><i class="fas fa-sign-in-alt me-1"></i>Register
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>