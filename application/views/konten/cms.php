<?php $this->load->view('layout_home/header'); ?>
<body>

  <nav class=" navbar navbar-light bg-light justify-content-between">
    <div class="container-fluid">
      <a href="#">
        <b class="navbar-brand">CMS</b>
      </a>

      <span class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-decoration-none text-body" href="#" id="navbarDropdown" role="button"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
          Hasbi
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Logout</a>

        </div>
      </span>
    </div>

  </nav>

  <div class="container my-4">
    <h3>Entry Course Online</h3>

    <div class="container bg-light p-4">
      <div class="row">
        <div class="col-sm-3">
          <p>Course</p>
        </div>
        <div class="col-sm-9">
          <p> : ACCT6018 2D ANIMATION</p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p>Course Credit Theory</p>
        </div>
        <div class="col-sm-9">
          <p> : 2</p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p>Course Credit Practicum</p>
        </div>
        <div class="col-sm-9">
          <p> : -</p>
        </div>
      </div>
    </div>

    <hr>

    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-outcomes-tab" data-toggle="tab" href="#nav-outcomes"
                role="tab" aria-controls="nav-outcomes" aria-selected="true">Student Outcomes</a>
              <a class="nav-item nav-link " id="nav-mapping-tab" data-toggle="tab" href="#nav-mapping" role="tab"
                aria-controls="nav-mapping" aria-selected="false">Mapping LO to LObj</a>
              <a class="nav-item nav-link" id="nav-resource-tab" data-toggle="tab" href="#nav-resource" role="tab"
                aria-controls="nav-resource" aria-selected="false">Resource</a>
              <a class="nav-item nav-link" id="nav-teaching-tab" data-toggle="tab" href="#nav-teaching" role="tab"
                aria-controls="nav-teaching" aria-selected="false">Teaching and Learning Strategy</a>
              <a class="nav-item nav-link" id="nav-topics-tab" data-toggle="tab" href="#nav-topics" role="tab"
                aria-controls="nav-topics" aria-selected="false">Topics</a>
              <a class="nav-item nav-link" id="nav-schedule-tab" data-toggle="tab" href="#nav-schedule" role="tab"
                aria-controls="nav-schedule" aria-selected="false">Schedule</a>
            </div>
          </nav>
          <div class="tab-content p-3 px-sm-0" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-outcomes" role="tabpanel" aria-labelledby="nav-outcomes-tab">

              <!-- content of student outcomes -->
              <h4>STUDENT OUTCOMES</h4>
              <h6 class="ml-2">Teaching & Learning Strategy</h6>
              <p class="ml-4"> Lecturing, Discussing, Hand of Practice</p>

              <b>* stands for XX references</b>

              <!-- table references -->

              <ul class="list-group my-4">
                <li class="list-group-item">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <td class="w-75">Student Outcome (1) :</td>
                        <td class="w-25">Status :</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="w-75">
                          <p> Able to create Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dignissimos
                            quo
                            quidem rem consequuntur beatae soluta, distinctio reiciendis tempora repudiandae impedit
                            corrupti! Iste corrupti quaerat molestiae praesentium sunt obcaecati et? </p>
                        </td>
                        <td class="w-25">
                          <p> Specific Student Outcon </p>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-75">
                          <i class="text-secondary"> Mampu membuat Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Optio dignissimos
                            quo
                            quidem rem consequuntur beatae soluta, distinctio reiciendis tempora repudiandae impedit
                            corrupti! Iste corrupti quaerat molestiae praesentium sunt obcaecati et? </i>
                        </td>
                        <td class="w-25"><i class="text-secondary"> Keterampilan Kerja Khusus </i></td>
                      </tr>
                    </tbody>
                  </table>

                </li>
                <li class="list-group-item">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th class="text-secondary"> Learning Objective (1) * </th>
                        <td class="w-25 text-center">Assesment Plan</td>
                        <td class="w-25 text-center">Weight</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="w-50">
                          <p> Able to create Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dignissimos
                            quo
                            quidem rem consequuntur beatae soluta, distinctio reiciendis tempora repudiandae impedit
                            corrupti! Iste corrupti quaerat molestiae praesentium sunt obcaecati et? </p>

                          <i class="text-secondary"> Mampu membuat Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Optio dignissimos
                            quo
                            quidem rem consequuntur beatae soluta, distinctio reiciendis tempora repudiandae impedit
                            corrupti! Iste corrupti quaerat molestiae praesentium sunt obcaecati et? </i>
                        </td>
                        <td class="w-25 text-center align-middle">Exam Question</td>
                        <td class="w-25 text-center align-middle">40%</td>
                      </tr>
                    </tbody>
                  </table>
                  <hr>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th class="text-secondary"> Learning Objective (3) * </th>
                        <td class="w-25 text-center">Assesment Plan</td>
                        <td class="w-25 text-center">Weight</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="w-50">
                          <p> Able to create Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dignissimos
                            quo
                            quidem rem consequuntur beatae soluta, distinctio reiciendis tempora repudiandae impedit
                            corrupti! Iste corrupti quaerat molestiae praesentium sunt obcaecati et? </p>

                          <i class="text-secondary"> Mampu membuat Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Optio dignissimos
                            quo
                            quidem rem consequuntur beatae soluta, distinctio reiciendis tempora repudiandae impedit
                            corrupti! Iste corrupti quaerat molestiae praesentium sunt obcaecati et? </i>
                        </td>
                        <td class="w-25 text-center align-middle">Exam Question</td>
                        <td class="w-25 text-center align-middle">40%</td>
                      </tr>
                    </tbody>
                  </table>
                  <hr>
                </li>
              </ul>
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
                      <th class="width-100p">LO 1 </th>
                      <th class="width-100p">LO 2 </th>
                      <th class="width-100p">LO 3 </th>
                      <th class="width-100p">LO 4 </th>
                      <th class="width-100p">LO 5 </th>
                      <th class="width-100p">LO 6 </th>
                      <th class="width-100p">Total LO to support </th>
                      <th class="width-100p"> Action </th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- table row -->

                    <tr>
                      <td class="width-100p">LOBj 1.1</td>
                      <td class="width-300p "> Able to Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Ab
                        quibusdam
                        consequatur
                        minima, iusto libero, nam dicta doloremque quidem quod fuga quam </td>
                      <td class="width-100p">
                        <span class="fa fa-times times1" lobj="1.1" lo="1" onclick="add(this,1)"></span>
                        <span class="fa fa-times times2" lobj="1.1" lo="1" onclick="add(this,2)"></span>
                      </td>
                      <td class="width-100p">
                        <span class="fa fa-times times1" lobj="1.1" lo="2" onclick="add(this,1)"></span>
                        <span class="fa fa-times times2" lobj="1.1" lo="2" onclick="add(this,2)"></span>
                      </td>
                      <td class="width-100p">
                        <span class="fa fa-times times1" lobj="1.1" lo="3" onclick="add(this,1)"></span>
                        <span class="fa fa-times times2" lobj="1.1" lo="3" onclick="add(this,2)"></span>
                      </td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p">
                        <button type="button" class="btn btn-primary btn-sm  btn-block">Save</button>
                      </td>
                    </tr>

                    <!-- end table row -->

                    <!-- table row -->

                    <tr>
                      <td class="width-100p"> LOBj 1.2</td>
                      <td class="width-300p "> Able to Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Ab
                        quibusdam
                        consequatur
                        minima, iusto libero, nam dicta doloremque quidem quod fuga quam </td>
                      <td class="width-100p">
                        <span class="fa fa-times times1" lobj="1.2" lo="1" onclick="add(this,1)"></span>
                        <span class="fa fa-times times2" lobj="1.2" lo="1" onclick="add(this,2)"></span>
                      </td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p">
                        <button type="button" class="btn btn-primary btn-sm  btn-block align-middle">Save</button>
                      </td>
                    </tr>

                    <!-- end table row -->

                    <!-- table row -->

                    <tr>
                      <td class="width-100p"> LOBj 1.3</td>
                      <td class="width-300p "> Able to Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Ab
                        quibusdam
                        consequatur
                        minima, iusto libero, nam dicta doloremque quidem quod fuga quam </td>
                      <td class="width-100p">

                      </td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p"></td>
                      <td class="width-100p text-center">
                        <button type="button" class="btn btn-warning btn-sm "> <i class="fa fa-pencil"
                            aria-hidden="true"></i> </button>
                      </td>
                    </tr>

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
    function add(ths, sno) {
      let lobj = (ths.getAttribute("lobj"))
      let lo = (ths.getAttribute("lo"))
      let fa = document.getElementsByClassName("fa-times")
      for (let i = 0; i < fa.length; i++) {
        let fa_lo = fa[i].getAttribute("lo")
        let fa_lobj = fa[i].getAttribute("lobj")
        if (fa_lo === lo && fa_lobj === lobj) {
          if (sno === 1 && $(fa[i]).hasClass("times2")) {
            $(fa[i]).removeClass("checked")
          } else {
            $(fa[i]).addClass("checked")
          }
        }
      }
    }
  </script>

</body>

</html>