<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="container">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h5 class="card-title d-inline">User Transaction List</h5>
                        </div>
                        <div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered border-primary">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users))
                                @foreach ($users as $key=>$item)
                                <tr>
                                    <td class="text-center">{{ $users->firstItem() + $key }}</td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userTransactionModal" wire:click.prevent="view({{ $item->id }})"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- User Transaction Modal -->
    <div class="modal" id="userTransactionModal" tabindex="-1" role="dialog" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">View Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                    <tr>
                                        <td class="text-center w-20">{{ $item->created_at->format('d.m.Y') }}</td>
                                        <td class="text-center w-20">
                                            @if($item->ttype == '0')
                                            <span class="text-success">Deposite</span>
                                            @else
                                            <span class="text-danger">Withdraw</span>
                                            @endif
                                        </td>
                                        <td class="text-center w-40">{{ $item->amount }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>