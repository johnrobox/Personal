
<!--     angular js  -->
@extends('layouts.app')

@section('content')

<div class="container" >
    
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="image">Search</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="image" placeholder="Search image here" ng-model="searchString">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4 pull-right">
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addProductModal">Add Product</button>
            </div>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Product List
        </div>
        <div class="panel-body">
            <h3 style="color: green" class="text-center"> [[ productMessage ]] </h3>
            <table class="table table-bordered">
                <tr>
                    <th>Item</th>
                    <th>Name</th>
                    <th>Descriptions</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>

                <tr ng-repeat="x in product_items | searchFor:searchString">
                    <td> [[ x.product_id ]]</td>
                    <td> [[ x.product_name ]]</td>
                    <td> [[ x.product_description ]]</td>
                    <td> [[ x.product_quantity ]]</td>
                    <td style="width: 160px;">
                        <button class="btn btn-success" ng-click="updateProduct([[x.product_id]])">Update</button>
                        <button class="btn btn-danger" ng-click="deleteProduct([[x.product_id]])">Delete</button>
                    </td>
                </tr>

            </table>
        </div>
        <div class="panel-footer">
            
        </div>
    </div>
</div>

        <div id ="addProductModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        Add Product
                    </div>
                        <div class="modal-body">
                            <div class="text-center" style="color: red" >[[ productErrorMessage ]]</div>
                            <div class="form-group">
                                <label for="product_name">Name</label>
                                <input type="text" id="product_name" class="form-control" ng-model="productNameValue"/>
                            </div>
                            <div class="form-group">
                                <label for="product_description">Descriptions</label>
                                <textarea class="form-control" id="product_description" ng-model="productDescValue"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_quantity">Quantity</label>
                                <input type="number" id="product_quantity" class="form-control" ng-model="productQuantityValue"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" ng-click="submitAddProduct()">Add</button>
                            <button class="btn btn-default" ng-click="cancelAddProduct()">Cancel</button>
                        </div>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                </div>
            </div>
        </div>


        <!--modal for delete a product -->
        <div id="deleteProductModal" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        Delete this product ?
                    </div>
                    <div class="modal-body">
                        <div class="text-center" style="color: red">[[ productDeleteError ]]</div>
                    </div>
                    <div class="modal-footer">
                        <button ng-click="submitProductDelete()" class="btn btn-primary">YES</button>
                        <button data-dismiss="modal" class="btn btn-default">NO</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- modal for update user -->
        <div id="updateProductModal" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">Update Product</div>
                    <div class="modal-body">
                        <Div class="text-center" style="color:red">[[ productUpdateError ]]</Div>
                        <div class="form-group">
                            <label for="productName">Product name</label>
                            <input type="text" id="productName" class="form-control" ng-model="productNameUpdateValue"/>
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Product description</label>
                            <textarea class="form-control" id="productDescription" ng-model="productDescUpdateValue" rows="5">
                                
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="productQuantity">Product quantity</label>
                            <input type="number" id="productQuantity" class="form-control" ng-model="productQuanUpdateValue"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" ng-click="submitProductUpdate()">Update</button>
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                </div>
            </div>
        </div>
        
@stop





