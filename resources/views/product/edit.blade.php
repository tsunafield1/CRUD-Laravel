<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            แก้ไขข้อมูลสินค้า
                        </div>
                        <div class="card-body">
                            <form action="{{route('updateProduct')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <label for="name">ชื่อสินค้า</label>
                                <input type="text" name="name" id="" class="form-control" value="{{$product->name}}">
                                @error('name')
                                    <b class="text-danger">{{$message}}</b>
                                    <br>
                                @enderror
                                <label for="image">รูปสินค้า</label>
                                <input type="file" name="image" id="" class="form-control">
                                @error('image')
                                    <b class="text-danger">{{$message}}</b>
                                    <br>
                                @enderror
                                <label for="price">ราคาสินค้า</label>
                                <input type="number" name="price" id="" class="form-control" value="{{$product->price}}">
                                @error('price')
                                    <b class="text-danger">{{$message}}</b>
                                    <br>
                                @enderror
                                <br>
                                <img src="{{asset($product->image)}}" alt="" width="300" height="300">
                                <br>
                                <input type="submit" value="แก้ไข" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
