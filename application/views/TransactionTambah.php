<?php foreach($userData as $aD){}; ?>
<html ng-app="myApp">

<script src="https://code.angularjs.org/1.3.0-rc.2/angular.js"></script>

<script>
    // Code goes here
    var app = angular.module('myApp', []);

    app.controller('PosController', function ($scope) {

        $scope.drinks = [
            <?php foreach($data as $d){ ?>
            {
                id: "<?=trim($d->p_code)?>",
                name: "<?=trim($d->p_name)?>",
                price: "<?=trim($d->p_price)?>",
                category: "<?=trim($d->p_category)?>",
            },
            <?php } ?>
        ];

        $scope.order = [];
        $scope.new = {};
        $scope.totOrders = 0;

        var url = window.location.protocol + "://" + window.location.host + "/" + window.location.pathname;

        $scope.getDate = function () {
            var today = new Date();
            var mm = today.getMonth() + 1;
            var dd = today.getDate();
            var yyyy = today.getFullYear();

            var date = dd + "/" + mm + "/" + yyyy

            return date
        };

        $scope.addToOrder = function (item, qty) {
            var flag = 0;
            if ($scope.order.length > 0) {
                for (var i = 0; i < $scope.order.length; i++) {
                    if (item.id === $scope.order[i].id) {
                        item.qty += qty;
                        flag = 1;
                        break;
                    }
                }
                if (flag === 0) {
                    item.qty = 1;
                }
                if (item.qty < 2) {
                    $scope.order.push(item);
                }
            } else {
                item.qty = qty;
                $scope.order.push(item);
            }
        };

        $scope.removeOneEntity = function (item) {
            for (var i = 0; i < $scope.order.length; i++) {
                if (item.id === $scope.order[i].id) {
                    item.qty -= 1;
                    if (item.qty === 0) {
                        $scope.order.splice(i, 1);
                    }
                }
            }
        };

        $scope.removeItem = function (item) {
            for (var i = 0; i < $scope.order.length; i++) {
                if (item.id === $scope.order[i].id) {
                    $scope.order.splice(i, 1);
                }
            }
        };

        $scope.getTotal = function () {
            returnCalculte();
            var tot = 0;
            for (var i = 0; i < $scope.order.length; i++) {
                tot += ($scope.order[i].price * $scope.order[i].qty)
            }
            return tot;
        };

        $scope.clearOrder = function () {
            $scope.order = [];
        };

        $scope.checkout = function (index) {
            alert($scope.getDate() + " - Order Number: " + ($scope.totOrders + 1) + "\n\nOrder amount: $" +
                $scope.getTotal().toFixed(2) + "\n\nPayment received. Thanks.");
            $scope.order = [];
            $scope.totOrders += 1;
        };

       
    });
</script>

<body class="skin-blue" style="height: auto; min-height: 100%;" data-ng-controller="PosController">
    <div class="wrapper" style="height: auto; min-height: 100%;">
        <?=$sidebar?>
        <div class="content-wrapper" style="min-height: 960px;">
            <section class="content-header">
                <h1>
                    TAMBAH TRANSAKSI
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->userdata('errorCode')=='transactionFailed'){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->userdata('errorMessage'); ?>
                        </div>
                        <?php }else if($this->session->userdata('errorCode')=='transactionSuccess'){ ?>
                        <div class="alert alert-success" role="alert">
                            <?= $this->session->userdata('errorMessage'); ?>
                        </div>
                        <?php } ?>
                        <?php
                $sessionData = array(
                  'errorMessage' => '',
                  'errorCode' => ''
                );
               $this->session->set_userdata($sessionData);
                ?>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">

                                <style>
                                    .padding-0{
    padding-right:0;
    padding-left:0;
    margin-bottom:5px;
}
</style>
                                <div class="box box-primary">
                                    <div class="box-body chart-responsive">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-7"><span class="panel-title">TRANSACTION SUMMARY</span></div>
                                                <div class="col-md-5"><span>HARI INI: {{getDate()}}</span></div>
                                            </div>
                                        </div>
                                        <form action="<?=base_url()?>transaksi/tambah-process" method="POST">
                                        <div class="panel-body" style="overflow: scroll ;max-height: 250px;">
                                            <div class="text-red" ng-hide="order.length">
                                                SILAHKAN PILIH PRODUK YANG DIBELI!
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item" ng-repeat="item in order">
                                                    <div class="row">
                                                    <input ng-value="item.id" name="idd[]" type="hidden">
                                                    <input ng-value="item.qty" name="qtt[]" type="hidden">
                                                        <div class="col-md-1">
                                                            <span class="badge badge-left" ng-bind="item.qty"></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            {{item.name}}
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                                <div class="col-md-12  padding-0">
                                                                    <div class="btn btn-primary btn-xs">{{item.price *
                                                                        item.qty |
                                                                        currency:"RP ":0}}</div>
                                                                </div>
                                                                <div class="col-md-12  padding-0">
                                                                    <div class="btn btn-warning btn-xs">{{item.price |
                                                                        currency:"RP ":0}}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-md-12 padding-0">
                                                                <button class="btn btn-primary btn-xs" ng-click="addToOrder(item,1)">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-12 padding-0">
                                                                <button class="btn btn-warning btn-xs" ng-click="removeOneEntity(item)">
                                                                    <span class="glyphicon glyphicon-minus"></span>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <button class="btn btn-danger btn-xs" ng-click="removeItem(item)">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="panel-footer" ng-show="order.length">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col col-lg-12">
                                                            <div class="form-group">
                                                                <p>GRAND TOTAL</p>
                                                                <input type="text" disabled class="form-control" id="inputtotal" ng-value="getTotal()"
                                                                    placeholder="Total">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col col-lg-12">
                                                            <div class="form-group">
                                                                <p>BAYAR</p>
                                                                <input type="number" class="form-control" required name="pay"
                                                                    id="pay">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col col-lg-6">
                                                            <div class="form-group">
                                                                <p>KEMBALIAN</p>
                                                                <input type="number" class="form-control" required name="kembalian"
                                                                    id="kembalian" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col col-lg-6">
                                                            <div class="form-group">
                                                                <p>CHECKOUT SEKARANG?</p>
                                                                <button type="submit" class="btn btn-primary btn-flat"
                                                                    id="btnplaceorder">CHECKOUT</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col col-lg-12">
                                                            <div class="form-group">
                                                                <p>BATALKAN TRANSAKSI?</p>
                                                                <button type="submit" class="btn btn-danger btn-flat"
                                                                ng-click="clearOrder()"
                                                    ng-disabled="!order.length">BATALKAN</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<!-- 
                                            <h3><span class="label label-primary">Total: {{getTotal() | currency:"RP
                                                    ":0}}</span></h3> -->
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="box box-primary" style="min-height:500px;">
                                    <div class="box-body chart-responsive">
                                        <div class="col col-lg-12">
                                            <div class="form-group" style="margin-top:15px;">
                                                <input id="filter" type="text" class="form-control" placeholder="CARI PRODUK...">
                                            </div>
                                        </div>
                                        <style>
                                            .cards {
                                                border: none;
                                                border-radius: 8px;
                                                margin-bottom: 20px;
                                                border: 2.5px solid #00a65a;
                                            }
                                        </style>
                                        <div class="col-md-4" data-ng-repeat="item in drinks" id="results">
                                      
                                        <a data-ng-click="addToOrder(item,1)">
                                                <div class="cards">
                                                    <span class="cards-text text-center">
                                                        <h5 style="color:#3c8dbc; font-size: 12px;margin-bottom:5px;margin-top:5px;"><b data-ng-bind="item.name"></b></h5>
                                                        <p style="color:#3c8dbc; font-size: 12px;" data-ng-bind="item.category"></p>
                                                        <p style="color:#3c8dbc; font-size: 12px;" data-ng-bind="item.price"></p>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        </div>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Ngkene Bae Resto Purbalingga © 2019</strong> All rights
            reserved.
        </footer>

        <div class="control-sidebar-bg"></div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#tableData').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $("#myTab a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
    
</script>
<script>

    function returnCalculte(){
        a = $("#pay").val();
        b = $("#inputtotal").val();
        c = a-b;
        if(c>=0){
        $("#kembalian").val(c);
        $("#btnplaceorder").removeAttr('disabled');

        }else{
        $("#kembalian").val(0);
        $("#btnplaceorder").attr('disabled','disabled');
        }
    }
$("#pay").keyup(function(){
    returnCalculte();
});
</script>

<script>
    $("#filter").keyup(function() {

// Retrieve the input field text and reset the count to zero
var filter = $(this).val(),
  count = 0;

// Loop through the comment list
$('#results div').each(function() {


  // If the list item does not contain the text phrase fade it out
  if ($(this).text().search(new RegExp(filter, "i")) < 0) {
    $(this).hide();

    // Show the list item if the phrase matches and increase the count by 1
  } else {
    $(this).show();
    count++;
  }

});

});

</script>