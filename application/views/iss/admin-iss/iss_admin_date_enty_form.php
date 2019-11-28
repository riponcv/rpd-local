   	<?php
    $attribute='';
    /*if(isset($login_office_status) && $login_office_status !=4)
    {
        $attribute='disabled="disabled"';
    }*/

    echo "<table align =center id=\"tbldesgTarget\"><tr><th>ISS Admin Panel</th></tr></table>";
   	if($this->session->flashdata('success_iss_process'))
    {
        echo "<div id='flashdata'>";
        echo '<font style="background-color:yellow;font-weight: bold;color: green;">'.$this->session->flashdata('success_wp').'</font>';
    	echo "</div>";
    }
	echo "<br/>";

    /*if(isset($login_office_status))
    {
     echo form_open('iss/','id=""');
    }*/

    //echo "<pre>";
    //print_r($query_issadmindate);
    ?>


<div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>ISS Entry
                    <small>Date</small>
                    <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New Date</a></div>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>ISS Entry Date</th>
                        <th>ISS Open Date</th>
                        <th>ISS End Date</th>
                        <th>ISS Certificate Date</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
				<?php foreach($query_issadmindate as $admindate) {?>
                <tbody id="show_data">
					<tr>
                        <td><?php echo isset($admindate->id)?$admindate->id:''; ?></td>
                        <td><?php
                        		$enD = date_create($admindate->ISSEntryDate);
                        		echo date_format($enD,"d-m-Y");
                        	?>
                        </td>
                        <td><?php
                        	$stD = date_create($admindate->stDate);
                        	echo date_format($stD,"d-m-Y");
                        	?>
                        </td>
                        <td><?php
                        	$endD = date_create($admindate->endDate);
                        	echo date_format($endD,"d-m-Y");
                        	?>

                        </td>
                        <td><?php
                        $cerD = date_create($admindate->CerendDate);
                        	echo date_format($cerD,"d-m-Y");
                        	?>
                        </td>
                    </tr>
                </tbody>
				<?php } ?>
            </table>
        </div>
    </div>

</div>

        <!-- MODAL ADD -->
            <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Entry Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ISS Base Date</label>
                            <div class="col-md-10">
								<div class="form-inline">
                                    <div id="personalDOB">
                                        <div class="form-group mob-fg">
                                            <select aria-label="Day" name="issBase_day" id="issBDay" title="Day" class="form-control" required="required" style="">
                                                <option value="0">Day</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Month" name="issBase_month" id="issBMonth" title="Month" class="form-control" required="required" style="">
                                                <option value="0">Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Year" name="issBase_year" id="issBYear" title="Year" class="form-control" required="required" style="">
                                            	<option label="2018" value="string:2018">Year</option>
                                            	<option label="2018" value="string:2018">2018</option>
                                            	<option label="2017" value="string:2017">2017</option>
                                            	<option label="2016" value="string:2016">2016</option>
                                            	<option label="2015" value="string:2015">2015</option>
                                            	<option label="2014" value="string:2014">2014</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ISS Open Date</label>
                            <div class="col-md-10">
                              <div class="form-inline">
                                    <div id="personalDOB">
                                        <div class="form-group mob-fg">
                                            <select aria-label="Day" name="issOpen_day" id="issODay" title="Day" class="form-control" required="required" style="">
                                                <option value="0">Day</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Month" name="issOpen_month" id="issOMonth" title="Month" class="form-control" required="required" style="">
                                                <option value="0">Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Year" name="issOpen_year" id="issOYear" title="Year" class="form-control" required="required" style="">
                                            	<option label="2018" value="string:2018">Year</option>
                                            	<option label="2018" value="string:2018">2018</option>
                                            	<option label="2017" value="string:2017">2017</option>
                                            	<option label="2016" value="string:2016">2016</option>
                                            	<option label="2015" value="string:2015">2015</option>
                                            	<option label="2014" value="string:2014">2014</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ISS End Date</label>
                            <div class="col-md-10">
                              <div class="form-inline">
                                    <div id="personalDOB">
                                        <div class="form-group mob-fg">
                                            <select aria-label="Day" name="issEnd_day" id="issEDay" title="Day" class="form-control" required="required" style="">
                                                <option value="0">Day</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Month" name="issEnd_month" id="issEMonth" title="Month" class="form-control" required="required" style="">
                                                <option value="0">Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Year" name="issEnd_year" id="issEYear" title="Year" class="form-control" required="required" style="">
                                            	<option label="2018" value="string:2018">Year</option>
                                            	<option label="2018" value="string:2018">2018</option>
                                            	<option label="2017" value="string:2017">2017</option>
                                            	<option label="2016" value="string:2016">2016</option>
                                            	<option label="2015" value="string:2015">2015</option>
                                            	<option label="2014" value="string:2014">2014</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ISS Certificate Date</label>
                            <div class="col-md-10">
                              <div class="form-inline">
                                    <div id="personalDOB">
                                        <div class="form-group mob-fg">
                                            <select aria-label="Day" name="issCer_day" id="issCerDay" title="Day" class="form-control" required="required" style="">
                                                <option value="0">Day</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Month" name="issCer_month" id="issCerMonth" title="Month" class="form-control" required="required" style="">
                                                <option value="0">Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="form-group mob-fg">
                                            <select aria-label="Year" name="issCer_year" id="issCerYear" title="Year" class="form-control" required="required" style="">
                                            	<option label="2018" value="string:2018">Year</option>
                                            	<option label="2018" value="string:2018">2018</option>
                                            	<option label="2017" value="string:2017">2017</option>
                                            	<option label="2016" value="string:2016">2016</option>
                                            	<option label="2015" value="string:2015">2015</option>
                                            	<option label="2014" value="string:2014">2014</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Product Code</label>
                            <div class="col-md-10">
                              <input type="text" name="product_code_edit" id="product_code_edit" class="form-control" placeholder="Product Code" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Product Name</label>
                            <div class="col-md-10">
                              <input type="text" name="product_name_edit" id="product_name_edit" class="form-control" placeholder="Product Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Price</label>
                            <div class="col-md-10">
                              <input type="text" name="price_edit" id="price_edit" class="form-control" placeholder="Price">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->

        <!--MODAL DELETE-->
         <form>
            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="product_code_delete" id="product_code_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->

<?php
	//echo form_close();
	?>


