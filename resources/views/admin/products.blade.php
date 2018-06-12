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
						<div class="col m4">
							<div class="input-field">
								<input type="number" step="0.01" name="pricing" required>
								<label for="pricing">Pricing BND</label>
							</div>
						</div>
						<div class="col m4">
							<div class="input-field">
								<input type="number" name="stock" required>
								<label for="stock">Availability</label>
							</div>
						</div>
						<div class="col m4">
							<div class="input-field">
								<input type="number" step="0.01" name="shipping" required>
								<label for="shipping">Shipping BND</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col m6 center-align">
					<img class="marginBottom10 marginLeft50" id="productimage">
					<input type="file" name="productimage" onchange="openFileProduct(event)" class="hidden" id="fileUpload">
					<label for="fileUpload">
						<a class="btn waves-effect waves-light blue white-text marginLeft50"><i class="material-icons left">file_upload</i>upload image</a>
					</label>
				</div>
				<div class="col m12">
					<div class="input-field">
						<textarea class="materialize-textarea" name="details"></textarea>
						<label for="details">Add details to the product</label>
					</div>
				</div>
			</div>
			<div class="input-field center-align">
				<button class="btn waves-effect waves-light green white-text"><i class="material-icons left">local_offer</i>Create new product</button>
			</div>
		</form>
	</div>
	<div class="container90 paddingTop20 paddingBottom20 hidden" id="editProductPanel">
		<form action="/admin/products/edit/{id}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row container90">
				<div class="col m6">
					<h6>Enter the following criterias for the product</h6>
					<br>
					<div class="input-field editName">
						<input type="text" name="name" required>
					</div>
					<div class="input-field editDescription">
						<textarea class="materialize-textarea" name="description"></textarea>
					</div>
					<div class="row">
						<div class="col m4">
							<div class="input-field editPricing">
								<input type="number" step="0.01" name="pricing" required>
							</div>
						</div>
						<div class="col m4">
							<div class="input-field editStock">
								<input type="number" name="stock" required>
							</div>
						</div>
						<div class="col m4">
							<div class="input-field editShipping">
								<input type="number" step="0.01" name="shipping" required>
							</div>	
						</div>
					</div>
				</div>
				<div class="col m6 center-align">
					<img class="marginBottom10 marginLeft50" id="editProductImage">
					<input type="file" name="productimage" onchange="openFileEdit(event)" class="hidden" id="fileUpload2">
					<label for="fileUpload2">
						<a class="btn waves-effect waves-light blue white-text marginLeft50"><i class="material-icons left">file_upload</i>upload image</a>
					</label>
				</div>
				<div class="col m12">
					<div class="input-field editDetails">
						<textarea class="materialize-textarea" name="details"></textarea>
					</div>
				</div>
			</div>
			<div class="input-field center-align">
				<button type="submit" class="btn waves-effect waves-light green white-text"><i class="material-icons left">edit</i>Update product</button>
				<a class="btn waves-effect waves-light red white-text cancelEdit"><i class="material-icons left">close</i>Cancel</a>
			</div>
		</form>
	</div>
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
				<td><a href="{{route('viewProduct', ['id' => $product->id])}}">{{$product->name}}</a></td>
				<td class="center">{{$product->stock}}</td>
				<td class="center">{{$product->pricing}}</td>
				<td class="center"><em>{{($product->tags) ? $product->tags : 'NULL'}}</em></td>
				<td class="center"></td>
				<td class="center">
					<div class="row paddingTop10 paddingBottom10 margin0">
						<div class="col s6 m6">
							<a href="#deleteProduct{{$product->id}}" class="btn waves-effect waves-light red white-text right modal-trigger"><i class="material-icons left">delete_forever</i>Delete</a>
						</div>
						<div class="col s6 m6">
							<a class="btn waves-effect waves-light blue white-text left getEdit" data-id="{{$product->id}}" id="editButton{{$product->id}}"><i class="material-icons left">edit</i>Edit</a>
						</div>
					</div>
				</td>
			</tr>

			<div class="modal" id="deleteProduct{{$product->id}}">
				<div class="modal-content">
					<h5 class="center">Are you sure you want to delete this product?</h5>
					<form action="{{route('deleteProduct', ['id' => $product->id])}}" method="POST">
						@csrf
						@method('DELETE')
						<div class="input-field center-align paddingTop30">
							<button class="btn waves-effect waves-light red white-text"><i class="material-icons left">delete_forever</i>Yes, Delete</button>
						</div>
					</form>
				</div>
			</div>
			@endforeach
		</tbody>
	</table>
</div>

@endsection

@section('js')
	<script src="{{asset('js/admin/products.js')}}"></script>
@endsection