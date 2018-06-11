@extends('layouts.admin')

@section('css')
	<link rel="stylesheet" type="text/css" href={{asset('css/admin/products.css')}}>
@endsection

@section('content')
<div class="container90">
	<h4 class="left">Products</h4>
	<button class="btn waves-effect waves-light green white-text right" id="newProduct"><i class="material-icons left">add</i>Add new product</button>
</div>

<div class="container90 paddingTop80 paddingBottom20">
	<div class="container90 hidden paddingTop20 paddingBottom20" id="newProductPanel">
		<form action="{{route('createProduct')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row container90">
				<div class="col m6">
					<h6>Enter the following criterias for a new product</h6>
					<br>
					<div class="input-field">
						<input type="text" name="name" required>
						<label for="name">Product name</label>
					</div>
					<div class="input-field">
						<textarea class="materialize-textarea" name="description"></textarea>
						<label for="description">Product description</label>
					</div>
					<div class="row">
						<div class="col m6">
							<div class="input-field">
								<input type="number" step="0.01" name="pricing" required>
								<label for="pricing">Product pricing BND</label>
							</div>
						</div>
						<div class="col m6">
							<div class="input-field">
								<input type="number" step="0.01" name="stock" required>
								<label for="stock">Availability</label>
							</div>
						</div>
					</div>
					<div class="input-field">
						<input type="number" step="0.01" name="shipping" required>
						<label for="shipping">Shipping rates BND</label>
					</div>	
				</div>
				<div class="col m6 center-align">
					<img class="marginBottom10 marginLeft30" id="productimage">
					<input type="file" name="productimage" onchange="openFileProfile(event)" class="hidden" id="fileUpload">
					<label for="fileUpload">
						<a class="btn waves-effect waves-light blue white-text marginLeft30"><i class="material-icons left">file_upload</i>upload image</a>
					</label>
				</div>
			</div>
			<div class="input-field center-align">
				<button class="btn waves-effect waves-light green white-text"><i class="material-icons left">local_offer</i>Create new product</button>
			</div>
		</form>
	</div>
	<div id="productPanel"></div>
</div>

<div class="container90">
	<table class="highlight responsive-table">
		<thead>
			<tr>
				<th>Name</th>
				<th class="center">Availability</th>
				<th class="center">Pricing</th>
				<th class="center">Tags</th>
				<th class="center">Orders</th>
				<th class="center">Action</th>
			</tr>
		</thead>

		<tbody>
			@foreach($products as $product)
			<tr>
				<td>{{$product->name}}</td>
				<td class="center">{{$product->stock}}</td>
				<td class="center">{{$product->pricing}}</td>
				<td class="center"><em>{{($product->tags) ? $product->tags : 'NULL'}}</em></td>
				<td class="center"></td>
				<td class="center">
					<div class="row paddingTop10 paddingBottom10 margin0">
						<div class="col s6 m6">
							<a href="#deleteProduct" class="btn waves-effect waves-light red white-text right modal-trigger"><i class="material-icons left">delete_forever</i>Delete</a>
						</div>
						<div class="col s6 m6">
							<a class="btn waves-effect waves-light blue white-text left getEdit" data-id="{{$product->id}}" id="editButton{{$product->id}}"><i class="material-icons left">edit</i>Edit</a>
						</div>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="modal" id="deleteProduct">
	<div class="modal-content">
		<h5 class="center">Are you sure you want to delete this product?</h5>
		<form action="{{route('deleteProduct', ['id' => $product->id])}}" method="POST">
			@csrf
			<div class="input-field center-align paddingTop30">
				<button class="btn waves-effect waves-light red white-text"><i class="material-icons left">delete_forever</i>Yes, Delete</button>
			</div>
		</form>
	</div>
</div>

@endsection

@section('js')
	<script src="{{asset('js/admin/products.js')}}"></script>
@endsection