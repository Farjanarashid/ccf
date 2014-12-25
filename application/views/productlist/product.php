<style>
    .clickable a{
        width:100%;
        display:block;
    }   
</style>
<section id="main-content">
    <section class="wrapper site-min-height">    
        <section class="panel">
            <header class="panel-heading">
                Product
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">

                        <div class="btn-group pull-right">
                            <a href="<?php echo site_url('productlist/product/addproductview'); ?>">
                                <button  class="btn btn-info" id="addproduct">
                                    Add New <i class="fa fa-plus"></i>
                                </button>
                            </a>
                        </div>                        
                    </div>                    
                    <table  class="display table table-bordered table-striped" id="cloudAccounting">
                        <thead>
                            <tr>
                                <th></th>                                
                                <th>Product Code</th>
                                <th>Description</th>
                                <th>Cost Price</th>
                                <th>Sale Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (sizeof($sortalldata) > 0):
                                foreach ($sortalldata as $rows):
                                    ?>
                                    <tr class="table_hand">
                                        <td><a data-toggle="modal" href="#unitdelete<?php echo $rows->productId ?>">
                                                <i class="fa fa-times-circle delete-icon"></i></a>
                                        </td>
                                        <td class="clickable"> <a href="<?php echo site_url('productlist/product/editproductview/' . $rows->productId) ?>"><?php echo $rows->productId ?></a></td>
                                        <td class="clickable"> <a href="<?php echo site_url('productlist/product/editproductview/' . $rows->productId) ?>"><?php echo $rows->description ?></a></td>                                      
                                        <td class="clickable"> <a href="<?php echo site_url('productlist/product/editproductview/' . $rows->productId) ?>">&nbsp;</a></td>
                                        <td class="clickable"> <a href="<?php echo site_url('productlist/product/editproductview/' . $rows->productId) ?>">&nbsp;</a></td>                                                                         

                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- delete unit start-->

            <!--Start Modal Delete Data -->
            <?php
            if (sizeof($sortalldata) > 0):
                foreach ($sortalldata as $unitvalue):
                    ?>
                    <div class="modal fade" id="unitdelete<?php echo $unitvalue->productId ?>" tabindex="-1" role="dialog" aria-labelledby="unitdelete" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="cmxform form-horizontal tasi-form" id="delaccgroup" method="post" action="<?php echo site_url('productlist/product/deleteproduct') ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel" align="Center"><b>Delete message</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="panel-body">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <p><h4><i class="fa fa-warning"></i>&nbsp; Are you sure want to delete Product:&nbsp;&nbsp;<?php echo '<span style="color: blue">' . $unitvalue->productName . '</span>'; ?></h4></p>
                                                        <input id="productId" name="productId" type="hidden" value="<?php echo $unitvalue->productId ?>" />                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="Submit" id="deleteproduct<?php echo $unitvalue->productId ?>" class="btn btn-danger">YES</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>            
                    <!-- Edit modal start-->
                    <div class="modal fade" id="unitedit<?php echo $unitvalue->productId ?>" tabindex="-1" role="dialog" aria-labelledby="unitdelete" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form class="cmxform form-horizontal" id="unitgroupedit" method="post" action="<?php echo site_url('productlist/product/editproduct'); ?>">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Product Information</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group ">
                                            <label for="productName" class="control-label col-lg-4">Product Name :</label>
                                            <div class="col-lg-8">
                                                <input class=" form-control" id="editproductName" name="editproductName" type="text" value="<?php echo $unitvalue->productName; ?>" required />
                                                <input class=" form-control" id="editproductId" name="editproductId" type="hidden" value="<?php echo $unitvalue->productId; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="productGroupId" class="control-label col-lg-4">Product Group :</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="editproductGroupId" name="editproductGroupId" type="text">
                                                    <option value="">--Product Group Under --</option>                                                   
                                                    <?php
                                                    foreach ($productlist as $prolist):
                                                        if ($unitvalue->productGroupId == $prolist->productGroupId):
                                                            ?>                                                    
                                                            <option selected value="<?php echo $prolist->productGroupId; ?>"><?php echo $prolist->productGroupName; ?></option>                                                    
                                                        <?php else:
                                                            ?>
                                                            <option value="<?php echo $prolist->productGroupId; ?>"><?php echo $prolist->productGroupName; ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                    ?> 
                                                    <option value="addprgrp"><?php echo 'Add New Product Group'; ?></option>
                                                </select>
                                                <span id="grpmsg"></span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="manufactureId" class="control-label col-lg-4">Manufacturer :</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="editmanufactureId" name="editmanufactureId" type="text">
                                                    <option value="">--Manufacturer Under --</option>
                                                    <?php
                                                    foreach ($manufaclist as $manus):
                                                        if ($unitvalue->manufactureId == $manus->manufactureId):
                                                            ?>
                                                            <option selected value="<?php echo $manus->manufactureId; ?>"><?php echo $manus->manufactureName; ?></option>
                                                        <?php else: ?>
                                                            <option  value="<?php echo $manus->manufactureId; ?>"><?php echo $manus->manufactureName; ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                    ?> 
                                                    <option value="addmanu"><?php echo 'Add New Manufacturer'; ?></option>
                                                </select>
                                                <span id="manumsg"></span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="stockMinimumLevel" class="control-label col-lg-4">Stock Minimum Level :</label>
                                            <div class="col-lg-8">
                                                <input class=" form-control" id="editstockMinimumLevel" name="editstockMinimumLevel" type="text" value="<?php echo $unitvalue->stockMinimumLevel; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="stockMaximumLevel" class="control-label col-lg-4">Stock Maximum Level :</label>
                                            <div class="col-lg-8">
                                                <input class=" form-control" id="editstockMaximumLevel" name="editstockMaximumLevel" type="text" value="<?php echo $unitvalue->stockMaximumLevel; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="unitId" class="control-label col-lg-4">Unit :</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="editunitId" name="editunitId" type="text">
                                                    <option value="">--Unit Under --</option>
                                                    <?php
                                                    foreach ($unitlist as $unit):
                                                        if ($unitvalue->unitId == $unit->unitId):
                                                            ?>
                                                            <option selected value="<?php echo $unit->unitId; ?>"><?php echo $unit->unitName; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?php echo $unit->unitId; ?>"><?php echo $unit->unitName; ?></option>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                    ?> 
                                                    <option value="addunit"><?php echo 'Add New Unit'; ?></option>
                                                </select>
                                                <span id="unitmsg"></span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="taxType" class="control-label col-lg-4">Tax Type :</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="edittaxType" name="edittaxType" type="text" >
                                                    <?php if ($unitvalue->taxType == "1"): ?>
                                                        <option value="1" selected >N/A</option>
                                                        <option value="2">Included</option>
                                                        <option value="3">Excluded</option>
                                                    <?php endif; ?>
                                                    <?php if ($unitvalue->taxType == "2"): ?>
                                                        <option value="1" >N/A</option>
                                                        <option value="2" selected>Included</option>
                                                        <option value="3">Excluded</option>
                                                    <?php endif; ?>
                                                    <?php if ($unitvalue->taxType == "3"): ?>
                                                        <option value="1">N/A</option>
                                                        <option value="2">Included</option>
                                                        <option value="3" selected>Excluded</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="tax" class="control-label col-lg-4">Tax% :</label>
                                            <div class="col-lg-8">
                                                <input class=" form-control" id="edittax" name="edittax" type="text" value="<?php echo $unitvalue->tax; ?>" />
                                            </div>
                                        </div>                                
                                        <div class="form-group ">
                                            <label for="description" class="control-label col-lg-4 ">Description</label>
                                            <div class="col-lg-8 col-sm-8">
                                                <textarea class="form-control" type="text" id="editdescription" name="editdescription" ><?php echo $unitvalue->description; ?></textarea>
                                            </div>
                                        </div>                                  
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" id="updateproduct<?php echo $unitvalue->productId ?>" class="btn btn-primary" value="Save"/>
                                        <input type="reset" class="btn btn-info" value="Clear"/>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end edit modal-->
                    <?php
                endforeach;
            endif;
            ?>
            <!--end delete modal-->
            <!-- Warning Delete modal for accessed-->
            <div class="modal fade" id="deletedinaccessed" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete message</h4>
                        </div>
                        <div class="modal-body">    
                            <p><h4><i class="fa fa-warning"></i>&nbsp;Sorry !! You can not delete this product!! This product is in used</h4></p>
                        </div>
                        <div class="modal-footer">                 
                            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        </div>
                    </div> 
                </div>
            </div>
            <!-- end warning delete modal-->
            <!-- end delete unit-->
            <!-- Add unit-->
            <div class="modal fade" id="addProductunit" tabindex="-1" role="dialog" aria-labelledby="addProductunit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="cmxform form-horizontal" id="unitgroupadd" method="post" action="<?php echo site_url('productlist/product/addproduct'); ?>">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add Product Information</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group ">
                                    <label for="productName" class="control-label col-lg-4">Product Name :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="productName" name="productName" type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="productGroupId" class="control-label col-lg-4">Product Group :</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" id="productGroupId" name="productGroupId" type="text">
                                            <option value="">--Product Group Under --</option>
                                            <?php foreach ($productlist as $prolist): ?>
                                                <option value="<?php echo $prolist->productGroupId; ?>"><?php echo $prolist->productGroupName; ?></option>
                                            <?php endforeach; ?> 
                                            <option value="addprgrp"><?php echo 'Add New Product Group'; ?></option>
                                        </select>
                                        <span id="grpmsg"></span>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="manufactureId" class="control-label col-lg-4">Manufacturer :</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" id="manufactureId" name="manufactureId" type="text">
                                            <option value="">--Manufacturer Under --</option>
                                            <?php foreach ($manufaclist as $manus): ?>
                                                <option value="<?php echo $manus->manufactureId; ?>"><?php echo $manus->manufactureName; ?></option>
                                            <?php endforeach; ?> 
                                            <option value="addmanu"><?php echo 'Add New Manufacturer'; ?></option>
                                        </select>
                                        <span id="manumsg"></span>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="stockMinimumLevel" class="control-label col-lg-4">Stock Minimum Level :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="stockMinimumLevel" name="stockMinimumLevel" type="text" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="stockMaximumLevel" class="control-label col-lg-4">Stock Maximum Level :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="stockMaximumLevel" name="stockMaximumLevel" type="text" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="unitId" class="control-label col-lg-4">Unit :</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" id="unitId" name="unitId" type="text">
                                            <option value="">--Unit Under --</option>
                                            <?php foreach ($unitlist as $unit): ?>
                                                <option value="<?php echo $unit->unitId; ?>"><?php echo $unit->unitName; ?></option>
                                            <?php endforeach; ?> 
                                            <option value="addunit"><?php echo 'Add New Unit'; ?></option>
                                        </select>
                                        <span id="unitmsg"></span>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="taxType" class="control-label col-lg-4">Tax Type :</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" id="taxType" name="taxType" type="text">
                                            <option value="1">N/A</option>
                                            <option value="2">Included</option>
                                            <option value="3">Excluded</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="tax" class="control-label col-lg-4">Tax% :</label>
                                    <div class="col-lg-8">
                                        <input class=" form-control" id="tax" name="tax" type="text" />
                                    </div>
                                </div>                                
                                <div class="form-group ">
                                    <label for="description" class="control-label col-lg-4 ">Description</label>
                                    <div class="col-lg-8 col-sm-8">
                                        <textarea class="form-control" type="text" id="description" name="description"></textarea>
                                    </div>
                                </div>                                  
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Save"/>
                                <input type="reset" class="btn btn-info" value="Clear"/>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
<?php if ($this->session->userdata('deleted') == 'Deleted'): ?>
    <script>
        $(document).ready(function () {
            $.gritter.add({
                title: 'Successfull!',
                text: 'Product deleted Successfully',
                sticky: false,
                time: '3000'
            });
        })
    </script>    
    <?php
    $this->session->unset_userdata('deleted');
endif;
?>
<?php if ($this->session->userdata('deleted') == 'Notdeleted'): ?>
    <script>
        $(document).ready(function () {
            $("#deletedinaccessed").modal('show');
        })
    </script>    
    <?php
    $this->session->unset_userdata('deleted');
endif;
?>
<script>
<?php $this->sessiondata = $this->session->userdata('logindata'); ?>
    $(document).ready(function () {
        var fyearstatus = "<?php echo $this->sessiondata['fyear_status']; ?>";
<?php foreach ($alldata as $unitvalue): ?>
            var id = "<?php echo $unitvalue->productId; ?>"
            if (fyearstatus == '0') {
                $("#updateproduct" + id).prop("disabled", true);
                $("#deleteproduct" + id).prop("disabled", true);
            }
<?php endforeach; ?>
        if (fyearstatus == '0') {
            $("#addproduct").prop("disabled", true);
        }
    });
</script>
<?php if ($this->session->userdata('success')): ?>
    <script>
        $(document).ready(function () {
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Successfull!',
                // (string | mandatory) the text inside the notification
                text: 'Action Completed Successfully',
                // (string | optional) the image to display on the left
                // image: 'img/avatar-mini.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '3000'
            });
        })
    </script>    
    <?php
    $this->session->unset_userdata('success');
endif;
?>
<?php if ($this->session->userdata('fail')): ?>
    <script>
        $(document).ready(function () {
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Successfull!',
                // (string | mandatory) the text inside the notification
                text: 'Failed to complete your action',
                // (string | optional) the image to display on the left
                // image: 'img/avatar-mini.jpg',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '3000'
            });
        })
    </script>    
    <?php
    $this->session->unset_userdata('success');
endif;
?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".clickableRow").click(function () {
            window.document.location = $(this).attr("href");
        });
    });
</script>