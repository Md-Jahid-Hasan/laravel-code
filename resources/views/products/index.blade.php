@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>


    <div class="card">
        <form action="{{ route('search.product') }}" method="post" class="card-header">
        @csrf
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <input type="text" name="title" placeholder="Product Title" class="form-control">
                </div>
                <div class="col-md-2">
                    <select name="variant" id="" class="form-control">
                    @foreach( $variant as $v)
                        @foreach( $v->product_varients as $pv)
                            <option Value="{{ $pv->id }}">{{$pv->variant}}</option>
                        @endforeach
                    @endforeach
                    
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price Range</span>
                        </div>
                        <input type="text" name="price_from" aria-label="First name" placeholder="From" class="form-control">
                        <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" placeholder="Date" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-response">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($product as $product)
                    <tr>
                        <td>1</td>
                        <td>{{$product->title}} <br> Created at : {{$product->created_at}}</td>
                        <td>{{$product->description}}</td>
                        <td>
                            <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">

                                <dt class="col-sm-3 pb-0">
                                    @foreach( $product->variant_price as $variant)

                                        @if (!empty($variant->product_variant_one))
                                            {{ $variant->product_variant_one }}/
                                            @endif
                                        @if (!empty($variant->product_variant_two))
                                            {{ $variant->product_variant_two }}/
                                            @endif
                                        @if (!empty($variant->product_variant_three))
                                            {{ $variant->product_variant_three }}/
                                        @endif
                                        
                                        <br>
                                    @endforeach
                                </dt>
                                
                                <dd class="col-sm-9">
                                    <dl class="row mb-0">
                                    @foreach( $product->variant_price as $variant)
                                        <dt class="col-sm-4 pb-0">Price : {{ number_format($variant->price,2) }}</dt>
                                        <dd class="col-sm-8 pb-0">InStock : {{ number_format($variant->stock,2) }}</dd>
                                        @endforeach
                                    
                                    </dl>
                                </dd>
                            </dl>
                            <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p>Showing 1 to 10 out of 100</p>
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
    </div>

@endsection
