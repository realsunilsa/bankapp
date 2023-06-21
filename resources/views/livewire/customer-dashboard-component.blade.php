<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="container">
                @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h5 class="card-title d-inline">Transaction List</h5>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#depositeModal"><i class="fas fa-plus-circle me-1"></i>Deposite</a>
                            <a href="javascript:void(0);" class="btn btn-secondary me-1" data-bs-toggle="modal" data-bs-target="#withdrawModal"><i class="fas fa-minus-circle me-1"></i>Withdraw</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered border-primary">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($transactions))
                                @foreach ($transactions as $key=>$item)
                                <tr>
                                    <td class="text-center">{{ $transactions->firstItem() + $key }}</td>
                                    <td>
                                        {{ $item->user->name }}
                                        <br>
                                        <small class="text-primary">Created {{ $item->created_at->format('d.m.Y')
                                            }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if($item->ttype == '0')
                                        <span class="text-success">Deposite</span>
                                        @else
                                        <span class="text-danger">Withdraw</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $item->amount }}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deposite Modal -->
    <div class="modal" id="depositeModal" tabindex="-1" role="dialog" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Deposite Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm">
                    </button>
                </div>
                <form wire:submit.prevent="deposite">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Amount<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter..." wire:model="amount">
                                    @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"><i class="fa fa-times me-1"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary float-end">
                            <div wire:loading wire:target="deposite" wire:key="deposite"><i class="fa fa-cog fa-spin me-1"></i>Please
                                wait...</div>
                            <div wire:loading.remove wire:target="deposite"><i class="fa fa-check-circle me-1"></i>Save</div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Withdraw Modal -->
    <div class="modal" id="withdrawModal" tabindex="-1" role="dialog" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Withdarw Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm">
                    </button>
                </div>
                <form wire:submit.prevent="withdraw">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Total balance</label>
                                    <input type="text" class="form-control" placeholder="Enter..." wire:model="balance" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter..." wire:model="amount">
                                    @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"><i class="fa fa-times me-1"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary float-end">
                            <div wire:loading wire:target="deposite" wire:key="deposite"><i class="fa fa-cog fa-spin me-1"></i>Please
                                wait...</div>
                            <div wire:loading.remove wire:target="deposite"><i class="fa fa-check-circle me-1"></i>Save</div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('depositeAdded', function() {
            $('#depositeModal').modal('hide');
        });

        Livewire.on('withdrawAdded', function() {
            $('#depositeModal').modal('hide');
        });
    });
</script>
@endpush