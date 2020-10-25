<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-md-6"><h2 class="font-weight-bold">Product List</h2></div>
                    <div class="col-md-6"><input type="text" wire:model="search" class="form-control" placeholder="Search Products..."></div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-3 mb-3">
                            <div class="card" wire:click="addItem({{ $product->id }})" style="cursor:pointer">
                                <img src="{{ asset('storage/images/'.$product->image) }}" alt="product_image" style="object-fit: contain;width:100%; height:170px">
                                <button wire:click="addItem({{ $product->id }})" class="btn btn-primary btn-sm" style="position:absolute;top:0;right:0;padding: 10px 15px"><i class="fas fa-cart-plus fa-lg"></i></button>
                                <h5 class="text-center font-weight-bold mt-2">{{ $product->name }}</h5>
                                <h6 class="text-center font-weight-bold" style="color:grey">Rp.{{ number_format($product['price'],0,',','.') }}</h6>
                            </div>
                        </div>
                    @empty
                    <div class="col-sm-12 mt-4">
                        <h2 class="text-center font-weight-bold text-primary">Sorry Products Not Found!</h2>
                    </div>
                    @endforelse
                </div>
                <div style="display:flex;justify-content:center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h3 class="font-weight-bold">Cart</h3>
            </div>
            <div class="card-body">
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>  
                @endif
                <table class="table table-sm table-bordered table-hovered">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carts as $index=>$cart)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                    <br>
                                    <i class="fas fa-trash" wire:click="removeItem('{{ $cart['rowId'] }}')" style="font-size:13px;cursor:pointer;color:red"></i>
                                </td>
                                <td>
                                    <a href="#" class="font-weight-bold text-dark">{{ $cart['name'] }}</a>
                                <br>
                                <a href="">Rp.{{ number_format($cart['pricesingle'],0,',','.') }}</a>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" style="padding:3px 6px" wire:click="decreaseItem('{{ $cart['rowId'] }}')"><i class="fas fa-minus"></i></button>
                                        {{ $cart['qty'] }}
                                    <button class="btn btn-info btn-sm" style="padding:3px 6px" wire:click="increaseItem('{{ $cart['rowId'] }}')"><i class="fas fa-plus"></i></button>
                                </td>
                                <td>Rp.{{ number_format($cart['price'],0,',','.') }}</td>
                            </tr>
                        @empty
                            <td colspan="4"><h6 class="text-center">Empty Cart</h6></td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="font-weight-bold">Cart Summary</h4>
                <h5 class="font-weight-bold">Sub Total  : Rp. {{ number_format($summary['sub_total'],0,',','.') }} </h5>
                <h5 class="font-weight-bold">Tax  : Rp. {{ number_format($summary['pajak'],0,',','.') }} </h5>
                <h5 class="font-weight-bold">Total  : Rp. {{ number_format($summary['total'],0,',','.') }} </h5>
                <div class="row">
                    <div class="col-sm-6">
                        <button wire:click="enableTax" class="btn btn-primary btn-block btn-sm">Add Tax</button>
                    </div>
                    <div class="col-sm-6">
                        <button wire:click="disableTax" class="btn btn-info btn-block btn-sm">Remove Tax</button>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-success btn-block">Save Transaction</button>
                </div>
            </div>
        </div>
    </div>
</div>
