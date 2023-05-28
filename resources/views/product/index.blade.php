<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            ตารางข้อมูลสินค้า
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Created_at</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>
                                                <img src="{{asset($row->image)}}" alt="" width="150px" height="150px">
                                            </td>
                                            <td>{{$row->price}}</td>
                                            <td>{{$row->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{url('product/edit/'.$row->id)}}" class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{url('product/delete/'.$row->id)}}" class="btn btn-danger"
                                                onclick="return confirm('ต้องการลบข้อมูลใช่หรือไม่?');">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            เพิ่มสินค้า
                        </div>
                        <div class="card-body">
                            <form action="{{route('addProduct')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="name">ชื่อสินค้า</label>
                                <input type="text" name="name" id="" class="form-control">
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
                                <input type="number" name="price" id="" class="form-control">
                                @error('price')
                                    <b class="text-danger">{{$message}}</b>
                                    <br>
                                @enderror
                                <br>
                                <input type="submit" value="เพิ่ม" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
