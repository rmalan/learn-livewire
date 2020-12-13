<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <h2>Products</h2>
            <hr />
            <form class="row g-3">
                <div class="col-md-4">
                    <label for="category" class="form-label">Category</label>
                    <select wire:model="category" class="form-select" id="category" name="category">
                        <option> -- Choose Category -- </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="product" class="form-label">Product</label>
                    <select wire:model="product" class="form-select" id="product" name="product">
                        <option> -- Choose Product -- </option>
                        @if(!is_null($products))
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $price }}" readonly>
                </div>
                <div class="col-md-1">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $amount }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary float-end">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>
