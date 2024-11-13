


 <div>
    <x-filament::breadcrumbs :breadcrumbs="[
        '/' => 'Home',
        '/admin/product-keys' => 'Product keys',
        '' => 'List',
    ]" />

    <div class="flex justify-between mt-1">
        <div class="font-bold text-3xl">Product Keys</div>
        <div>
            {{ $data }}
        </div>
    </div>

    <div>
        <!-- Access the selectedProductId directly -->
        <form wire:submit.prevent="save" class="w-full max-w-sm flex mt-2">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="productSelect">
                    Select Product
                </label>
                <select id="productSelect" wire:model="selectedProductId"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                               leading-tight focus:outline-none focus:shadow-outline">
                    <option value="" selected disabled>Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fileInput">
                    Upload csv
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                       leading-tight focus:outline-none focus:shadow-outline"
                       id="fileInput" type="file" wire:model='file'>
            </div>
            <div class="flex items-center justify-between mt-3">
                <button class="bg-blue-500 hover:bg-blue-700 text-blue font-bold py-2 px-4 rounded
                        focus:outline-none focus:shadow-outline"
                        type="submit">
                        Upload
                </button>
            </div>
        </form>
    </div>
</div>




