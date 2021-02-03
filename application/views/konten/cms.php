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
					<a class="nav-link dropdown-toggle text-decoration-none text-uppercase text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
					<p id="course"> : </p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<p  class="text-muted">Course Credit Theory</p>
				</div>
				<div class="col-sm-9">
					<p id="course_credit_theory"> : 2</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<p class="text-muted">Course Credit Practicum</p>
				</div>
				<div class="col-sm-9">
					<p id="course_credit_practicum"> : -</p>
				</div>
			</div>
		</div>

		<div class="container my-4">
			<div class="row">
				<div class="col-12">
					<nav>
						<div class="nav nav-tabs border-bottom nav-fill d-flex align-content-center" id="nav-tab" role="tablist">
							<i class="fa fa-2x fa-chevron-left" aria-hidden="true"></i>

							<a class="nav-item nav-link active" id="nav-outcomes-tab" data-toggle="tab" href="#nav-outcomes" role="tab" aria-controls="nav-outcomes" aria-selected="true">Student Outcomes</a>
							<a class="nav-item nav-link " id="nav-mapping-tab" data-toggle="tab" href="#nav-mapping" role="tab" aria-controls="nav-mapping" aria-selected="false">Mapping
								LO to LObj</a>
							<a class="nav-item nav-link" id="nav-resource-tab" data-toggle="tab" href="#nav-resource" role="tab" aria-controls="nav-resource" aria-selected="false">Resource</a>
							<a class="nav-item nav-link" id="nav-teaching-tab" data-toggle="tab" href="#nav-teaching" role="tab" aria-controls="nav-teaching" aria-selected="false">Teaching and Learning
								Strategy</a>
							<a class="nav-item nav-link" id="nav-topics-tab" data-toggle="tab" href="#nav-topics" role="tab" aria-controls="nav-topics" aria-selected="false">Topics</a>
							<a class="nav-item nav-link" id="nav-schedule-tab" data-toggle="tab" href="#nav-schedule" role="tab" aria-controls="nav-schedule" aria-selected="false">Schedule</a>

							<i class="fa fa-2x fa-chevron-right" aria-hidden="true"></i>

						</div>
					</nav>
					<div class="tab-content p-3 bg-light " id="nav-tabContent">
						<div class="tab-pane fade show active " id="nav-outcomes" role="tabpanel" aria-labelledby="nav-outcomes-tab">

							<!-- content of student outcomes -->
							<h4>STUDENT OUTCOMES</h4>
							

							<b>* stands for XX references</b>

							<!-- table references -->

							<div id="render_so"></div>
							<!-- end table references -->


							<!-- end content of student outcomes -->
						</div>

						<div class="tab-pane fade " id="nav-mapping" role="tabpanel" aria-labelledby="nav-mapping-tab">

							<!-- content of mapping LO to LOBj -->

							<h4>MAPPING LO to L.ObJ</h4>
							<b>* stand for XX references </b>



							<div class="table-responsive" id="mappingTableArea">
								<table id="mappingTable" class="table table-bordered fontsize-8" width="100%">

								</table>
							</div>
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
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js">
	</script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

	<script>
		let temp = []
		function objectifyForm(formArray = []) {
			let returnArray = {};
			let detailObj = {}
			for (var i = 0; i < formArray.length; i++) {
				if (Number.isInteger(+formArray[i]['name'])) {
					detailObj = {
						...detailObj,
						[formArray[i]['name']]: formArray[i]['value']
					}
					returnArray["detail"] = detailObj
				} else {
					returnArray[formArray[i]['name']] = formArray[i]['value'];
				}
			}
			return returnArray;
		}

		


		function add(ths, sno) {
			let lobj = (ths.getAttribute("lobj"))
			let lo = (ths.getAttribute("lo"))
			let id = (ths.getAttribute("lobj2"))
			let inputHidden = $("." + id)
			let editedLobj = $("button[isEditActive='true']");
			if (editedLobj.length > 0) {
				let fix = editedLobj.filter((index, element) => {
					return element.getAttribute("lobj") === lobj;
				});
				if ($(fix).attr("lobj") === lobj) {
					let fa = $(".fa-times")
					for (let i = 0; i < fa.length; i++) {
						let fa_lo = fa[i].getAttribute("lo")
						let fa_lobj = fa[i].getAttribute("lobj")
						if (fa_lo === lo && fa_lobj === lobj) {
							if (sno === 1) {
								// klik silang ke-1
								if ($(fa[i]).hasClass("times2")) {
									//   hapus nilai silang ke-2
									$(fa[i]).removeClass("checked");
								} else {
									if ($(fa[i]).hasClass("checked")) {
										// hapus silang pertama jika aktif menjadi 0
										$(inputHidden).val(0)
										$(fa[i]).removeClass("checked");
										$("#mapping" + id).attr("value", "0");
									} else {
										// menambah silang pertama jika tidak aktif menjadi 1
										$(fa[i]).addClass("checked");
										$(inputHidden).val("1")
										$("#mapping" + id).attr("value", 1);
									}
								}
							} else {
								// klik silang ke-2
								$(fa[i]).addClass("checked");
								$(inputHidden).val("2")

								$("#mapping" + id).attr("value", 2);
							}
						}
					}
				}
			}
		}

		function changeButton(ths) {
			let lobj = ths.getAttribute("lobj");
			let isEditActive = ths.getAttribute("isEditActive");
			if (isEditActive === "true") {

				let row = $(ths).parents("tbody");
				let inputs = row.find("input")
				let data = objectifyForm($(inputs).serializeArray())
				$.ajax({
						type: "POST",
						url: "index.php/home/saveData",
						data: JSON.stringify({detail : {...data}}),
						cache: false,
						success: function(data) {
							alert(data);
						},
						error: function(err) {
							alert("FAILED")
						}
					});

				$(ths).attr("isEditActive", "false");
				$(ths)
					.empty()
					.append('<i class="fa fa-pencil" aria-hidden="true"></i>');
			} else {
				$(ths).attr("isEditActive", "true");
				$(ths).empty().append("Save");
				
			}
		}

		$(document).ready(() => {

			$.ajax({
				url: 'index.php/home/getmappingSO',
				type: "GET",
				success: function(res) {
					console.log(res)
					renderSO(res.so)
					renderMapping(res.mapping)
					$("#course").text(res.so[0].statusSONameIN)
					$("#course_credit_theory").text(res.so[0].learningObjs[0].descEN)
					$("#course_credit_practicum").text(res.so[0].learningObjs[0].descIN)
				},
				error: function(err) {
					alert("FAILED")
				}
				
			})
			
		})

		function renderSO(dataSO = []) {
			temp = dataSO;
			if(dataSO.length <= 0){
				$("#render_so").append(`<ul class="list-group my-4"> 
					<li class="list-group-item">
						<h2> Data Empty </h2>
					</li>
				</ul>`)
			}else {
			dataSO.forEach(so => {
				$("#render_so").append(
					`<ul class="list-group my-4">
								<li class="list-group-item">
									<table class="table table-borderless">
										<thead>
											<tr>
												<td class="w-75">Student Outcome
													${so.statusSOId}
													:</td>
												<td class="w-25">Status :</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="w-75">
													<p> ${so.descEN} </p>
												</td>
												<td class="w-25">
													<p> ${so.descIN} </p>
												</td>
											</tr>
											<tr>
												<td class="w-75">
													<i class="text-secondary"> ${so.statusSONameEN} </i>
												</td>
												<td class="w-25"><i class="text-secondary"> ${so.statusSONameIN}
													</i></td>
											</tr>
										</tbody>
									</table>
								</li>

								${so.learningObjs.map((lobj, i) => {
									return (
										`<li class="list-group-item" key=${i}>
											<table class="table table-borderless">
												<thead>
													<tr>
														<th class="text-secondary w-25"> Learning Objective
															${lobj.code} <b> ${lobj.isXX ? "*" :" "} </b> </th>
														<td class="w-25 text-center">Teaching & Learning Strategy</td>
														<td class="w-25 text-center">Assesment Plan</td>
														<td class="w-25 text-center">Weight</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="w-25">
															<p> ${lobj.descEN} </p>

															<i class="text-secondary"> ${lobj.descIN} </i>
														</td>
														<td class="w-25 text-center align-middle">${lobj.teachAndLearnStrategyName}</td>
														<td class="w-25 text-center align-middle">${lobj.assessmentPlan}</td>
														<td class="w-25 text-center align-middle">${lobj.weight}% </td>
													</tr>
												</tbody>
											</table>
											<hr>
										</li>`
									)
								})}
							</ul>`
					)
				})
			}
		}


		function renderMapping(dataMapping = []) {
			if(temp.length <= 0){
				$("#mappingTable").append(`<ul class="list-group my-4"> 
					<li class="list-group-item">
						<h2> Data Empty </h2>
					</li>
				</ul>`)
			}
			else{
			let LOData = dataMapping[0].LO
			$("#mappingTable").append(`
				<thead>
					<tr>
						<th class="width-100p"></th>
						<th class="width-300p"></th>
						${LOData.map(lo => {
							return `<th class="width-100p">LO ${lo.courseOutlineLearningOutcomeID} </th>`
						})}
						<th class="width-100p">Total LO to support </th>
						<th class="width-100p"> Action </th>
					</tr>
				</thead>
			`)

			$("#mappingTable").append(`
				<tbody>
					${dataMapping.map((row, i) => {
						return (`
						<tr>
							
							<td class="mapping-td-${i} width-100p"> ${row.code} <b> ${row.isXX ? "*" :" "} </b> </td>
							<td class="mapping-td-${i} width-300p"> ${row.descEN}  </td>

							${row.LO.map(data_lo => {
								let check1 = ""
								let check2 = ""
								if(data_lo.weightLO == 2){
									check1="checked"; 
									check2="checked"
								}else if (data_lo.weightLO == 1) check1="checked"
								return (`<td class="mapping-td-${i} width-100p">
									<span class="fa fa-times times1 ${check1}" lobj="${row.courseLObjID}" lo="${data_lo.courseOutlineLearningOutcomeID}" lobj2="${data_lo.courseLObj2LOId}" onclick="add(this,1)" ></span>
									<span class="fa fa-times times2 ${check2}" lobj="${row.courseLObjID}" lo="${data_lo.courseOutlineLearningOutcomeID}" lobj2="${data_lo.courseLObj2LOId}" onclick="add(this,2)" ></span>
									<input type="hidden" form="formLobj-${i}" value="${data_lo.weightLO}" name="${data_lo.courseLObj2LOId}" class="${data_lo.courseLObj2LOId}">
									<input type="hidden" form="formLobj-${i}" value="${data_lo.weightLO}">
								</td>`)

							})
								
							
							}
							
							<td class="width-100p"> ${LOData.length} </td> 
							<td class="width-100p">
								<button isEditActive="false" onclick="changeButton(this)"  lobj="${row.courseLObjID}" class="btn btn-yellow btn-sm d-flex p-2 mx-auto" >
									<i class="fa fa-pencil" aria-hidden="true"></i> 
								</button> 
							</td> 
							
						</tr>

						`)
					})}
					
				</tbody>
			`)
		}	


		}


	</script>

</body>

</html>