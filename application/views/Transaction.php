<div class="col-md-12" style="margin-top:110px;">
	<div style="color:#fff;margin-top:-30px;">
		<span class="fa fa-home"></span><span> Dashboards</span>
	</div>
	<h3 class="text-center" style="color:#fff">BUY</h3>
	<h3 class="text-center" style="color:#fff">Select Customer</h3>
	<br>
	<div class="col-12 col-md-6 offset-md-3" style="padding:0px 150px;">
		<div class="row">
			<div class="card shadow mb-4">
				<!-- Card Header - Accordion -->
				<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
					aria-expanded="true" aria-controls="collapseCardExample">
					<h6 class="m-0 font-weight-bold text-primary">SELECT CUSTOMER</h6>
				</a>
				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardExample" style="">
					<div class="card-body">
						<form action="<?=base_url()?>transaction/buy-add-to-cart/" method="post">
							<input type="hidden" name="idMaterial" value="<?=$this->uri->segment(3)?>">
							<div class="form-group">
								<label>CUSTOMER</label>
								<select name="materialType" required class="form-control select2 w-100">
									<?php foreach($customer as $c){ ?>
									<option value="<?=$c->c_id?>">
										<?=$c->c_name?>
									</option>
									<?php } ?>
								</select>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12 mb-3">
											<a href="http://localhost:1996/iloveemas/transaction/buy/"
												class="btn btn-primary btn-icon-split btn-lg btn-block">
												<span class="text">New Customer</span>
											</a>
										</div>
										<div class="col-md-4">
											<a href="http://localhost:1996/iloveemas/transaction/buy/"
												class="btn btn-primary btn-icon-split btn-lg btn-block">
												<span class="text">Sell</span>
											</a>
										</div>
										<div class="col-md-4">
											<a href="http://localhost:1996/iloveemas/transaction/buy/"
												class="btn btn-primary btn-icon-split btn-lg btn-block">
												<span class="text">Buy</span>
											</a>
										</div>
										<div class="col-md-4">
											<a href="http://localhost:1996/iloveemas/transaction/"
												class="btn btn-primary btn-icon-split btn-lg btn-block">
												<span class="text">Back</span>
											</a>
										</div>
										
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#materialType").select2();
	$(".select2").select2();
</script>