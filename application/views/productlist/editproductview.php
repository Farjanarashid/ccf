
<section id="main-content">
    <section class="wrapper site-min-height">    
        <section class="panel">
            <header class="panel-heading">
                Edit Product Information
            </header>
            <div class="panel-body">
                <?php
                if (sizeof($databyid) > 0):
                    foreach ($databyid as $unitvalue):
                        ?>
                        <form class="cmxform form-horizontal" id="unitgroupedit" method="post" action="<?php echo site_url('productlist/product/editproduct'); ?>">
                            
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
                                    <label for="description" class="control-label col-lg-4 ">Description:</label>
                                    <div class="col-lg-8 col-sm-8">
                                        <textarea class="form-control" type="text" id="editdescription" name="editdescription" ><?php echo $unitvalue->description; ?></textarea>
                                    </div>
                                </div>                                  
                            </div>
                            <div class="modal-footer" style="text-align: center">
                                <input type="submit" class="btn btn-primary" value="Update"/>&nbsp;&nbsp;&nbsp;                                  
                                <a  href="<?php echo site_url('productlist/product') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
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
        </section>
    </section>
</section>