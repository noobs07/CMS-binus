<?php $this->load->view('layout_home/header'); ?>

<body>
	<nav class=" navbar navbar-dark bg-headnav justify-content-between">
		<div class="container-fluid">
			<a href="#">
				<b class="navbar-brand">CMS</b>
			</a>
			<div class="d-flex align-items-center">
				<i type="button" class="fa fa-info-circle fa-lg text-white mx-4 c-pointer" aria-hidden="true">
					<span class="badge badge-warning notify-badge">0</span>
				</i>
				<span class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-decoration-none text-uppercase text-light" href="#"
						id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						Rafli Tantowi Ramadhan
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Logout</a>
					</div>
				</span>
			</div>
		</div>
	</nav>

	<div class="bg-light">
		<button class="btn-warning btn rounded-0 text-white text-right pl-4">Login As <br> STAFF</button>
	</div>

	<div class="container my-4">
		<div class="d-flex justify-content-between my-3">
			<h3>Entry Course Online</h3>
			<button type="button" class="btn btn-yellow">Back</button>
		</div>
		<div class="container bg-light p-4 border rounded">
			<div class="row">
				<div class="col-sm-3">
					<p class="text-muted">Course</p>
				</div>
				<div class="col-sm-9">
					<p> : ACCT6018 2D ANIMATION</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<p class="text-muted">Course Credit Theory</p>
				</div>
				<div class="col-sm-9">
					<p> : 2</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<p class="text-muted">Course Credit Practicum</p>
				</div>
				<div class="col-sm-9">
					<p> : -</p>
				</div>
			</div>
		</div>

		<div class="container my-4">
			<div class="row">
				<div class="col-12">
					<nav>
						<div class="nav nav-tabs border-bottom nav-fill d-flex align-content-center" id="nav-tab"
							role="tablist">
							<i class="fa fa-2x fa-chevron-left" aria-hidden="true"></i>

							<a class="nav-item nav-link active" id="nav-outcomes-tab" data-toggle="tab"
								href="#nav-outcomes" role="tab" aria-controls="nav-outcomes"
								aria-selected="true">Student Outcomes</a>
							<a class="nav-item nav-link " id="nav-mapping-tab" data-toggle="tab" href="#nav-mapping"
								role="tab" aria-controls="nav-mapping" aria-selected="false">Mapping LO to LObj</a>
							<a class="nav-item nav-link" id="nav-resource-tab" data-toggle="tab" href="#nav-resource"
								role="tab" aria-controls="nav-resource" aria-selected="false">Resource</a>
							<a class="nav-item nav-link" id="nav-teaching-tab" data-toggle="tab" href="#nav-teaching"
								role="tab" aria-controls="nav-teaching" aria-selected="false">Teaching and Learning
								Strategy</a>
							<a class="nav-item nav-link" id="nav-topics-tab" data-toggle="tab" href="#nav-topics"
								role="tab" aria-controls="nav-topics" aria-selected="false">Topics</a>
							<a class="nav-item nav-link" id="nav-schedule-tab" data-toggle="tab" href="#nav-schedule"
								role="tab" aria-controls="nav-schedule" aria-selected="false">Schedule</a>

							<i class="fa fa-2x fa-chevron-right" aria-hidden="true"></i>

						</div>
					</nav>
					<div class="tab-content p-3 bg-light" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-outcomes" role="tabpanel"
							aria-labelledby="nav-outcomes-tab">

							<!-- content of student outcomes -->
							<h4>STUDENT OUTCOMES</h4>
							<h6 class="ml-2">Teaching & Learning Strategy</h6>
							<p class="ml-4"> Lecturing, Discussing, Hand of Practice</p>

							<b>* stands for XX references</b>

							<!-- table references -->

							<?php foreach($so as $data_so){?>
              <ul class="list-group my-4">
								<li class="list-group-item">
									<table class="table table-borderless">
										<thead>
											<tr>
												<td class="w-75">Student Outcome (<?=$data_so->courseStudentOutcomeId?>) :</td>
												<td class="w-25">Status :</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="w-75">
													<p> <?=$data_so->nameEN?></p>
												</td>
												<td class="w-25">
													<p> Specific Student Outcon </p>
												</td>
											</tr>
											<tr>
												<td class="w-75">
													<i class="text-secondary"> <?=$data_so->nameIN?> </i>
												</td>
												<td class="w-25"><i class="text-secondary"> Keterampilan Kerja Khusus
													</i></td>
											</tr>
										</tbody>
									</table>

								</li>
                <li class="list-group-item">
									<?php $i=0; foreach($data_so->LObj as $lobj){?>
                  <table class="table table-borderless">
										<thead>
											<tr>
												<th class="text-secondary"> Learning Objective (<?=$lobj->courseLObjID ?>) * </th>
												<td class="w-25 text-center">Assesment Plan</td>
												<td class="w-25 text-center">Weight</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="w-50">
													<p> <?=$lobj->descEN ?> </p>

													<i class="text-secondary"> <?=$lobj->descIN ?> </i>
												</td>
												<td class="w-25 text-center align-middle">Exam Question</td>
												<td class="w-25 text-center align-middle">40%</td>
											</tr>
										</tbody>
									</table>
                <?php $i++;} ?>
									<hr>
								</li>
							</ul>
              <?php }?>
							<!-- end table references -->


							<!-- end content of student outcomes -->
						</div>

						<div class="tab-pane fade " id="nav-mapping" role="tabpanel" aria-labelledby="nav-mapping-tab">

							<!-- content of mapping LO to LOBj -->

							<h4>MAPPING LO to L.ObJ</h4>
							<b>* stand for XX references </b>

							<!-- table of mapping -->


							<div class="table-responsive" id="mappingTableArea">
								<table id="mappingTable" class="table table-bordered fontsize-8" width="100%">
									<thead>
										<tr>
											<th></th>
											<th class="width-300p"></th>
											<?php 
											$LO=$mapping['0']['LO'];
											foreach($LO as $dataLO){?>
											<th class="width-100p">LO <?=$dataLO['courseOutlineLearningOutcomeID']?> </th>
											<?php } ?>
											<th class="width-100p">Total LO to support </th>
											<th class="width-100p"> Action </th>
										</tr>
									</thead>
									<tbody>

										<!-- table row -->
<?php foreach($mapping as $dataMapping){?>
										<tr>
											<td class="width-100p"><?=$dataMapping['code']?></td>
											<td class="width-300p "> <?=$dataMapping['descIN']?> </td>
											<?php foreach($dataMapping['LO'] as $data_lo){?>
											<td class="width-100p">
												<span class="fa fa-times times1" lobj="<?=$dataMapping['courseLObjID']?>" lo="<?=$data_lo['courseOutlineLearningOutcomeID']?>" lolobj="<?=$data_lo['courseLObj2LOID']?>"
													onclick="add(this,1, <?=$data_lo['courseLObj2LOID']?>)"></span>
												<span class="fa fa-times times2" lobj="<?=$dataMapping['courseLObjID']?>" lo="<?=$data_lo['courseOutlineLearningOutcomeID']?>" lolobj="<?=$data_lo['courseLObj2LOID']?>"
													onclick="add(this,2, <?=$data_lo['courseLObj2LOID']?>)"></span>
													<input type="hidden" value="0" name="mapping<?=$data_lo['courseLObj2LOID']?>" id="mapping<?=$data_lo['courseLObj2LOID']?>">
											</td>
										<?php } ?>
											<td class="width-100p"></td>
											<td class="width-100p">
												<button type="button"
													class="btn btn-yellow btn-sm  btn-block">Save</button>
											</td>
										</tr>
<?php } ?>
										<!-- end table row -->


									</tbody>
								</table>
							</div>
							<!-- end table of mapping -->



							<!-- end content of mapping LO to LOBj -->

						</div>

						<div class="tab-pane fade" id="nav-resource" role="tabpanel" aria-labelledby="nav-resource-tab">
							Resource
						</div>
						<div class="tab-pane fade" id="nav-teaching" role="tabpanel" aria-labelledby="nav-teaching-tab">
							Teaching and Learning
						</div>
						<div class="tab-pane fade" id="nav-topics" role="tabpanel" aria-labelledby="nav-topics-tab">
							Topics
						</div>
						<div class="tab-pane fade" id="nav-schedule" role="tabpanel" aria-labelledby="nav-schedule-tab">
							Schedule
						</div>

					</div>
				</div>
			</div>
		</div>



	</div>

	<div class="bottom bg-dark text-center py-3 text-white">
		<b>BINUS UNIVERSITY</b>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
		integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
	</script>

	<script>
		function add(ths, sno, id) {
			let lobj = (ths.getAttribute("lobj"))
			let lo = (ths.getAttribute("lo"))
			let fa = document.getElementsByClassName("fa-times")
			for (let i = 0; i < fa.length; i++) {
				let fa_lo = fa[i].getAttribute("lo")
				let fa_lobj = fa[i].getAttribute("lobj")
				if (fa_lo === lo && fa_lobj === lobj) {
					console.log(fa[i])
					if (sno === 1) {
						if ($(fa[i]).hasClass("times2")) {
							$(fa[i]).removeClass("checked");
							document.getElementById('mapping'+id).value='0' ;
						} else {
							if ($(fa[i]).hasClass("checked")) {
								$(fa[i]).removeClass("checked");
								document.getElementById('mapping'+id).value='0';
							} else {
								$(fa[i]).addClass("checked");
								document.getElementById('mapping'+id).value='1' ;
							}
						}
					} else {
						console.log(fa[i])
						$(fa[i]).addClass("checked");
						document.getElementById('mapping'+id).value='2' ;
					}
				}
			}
		}

	</script>

</body>

</html>
