<div class="col-md-12 col-lg-12 ">
    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Service Provider Category </b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($service_provider_category)):
                ?>
                <form method="post" class="form-horizontal" role="form" >

                    <table class="table table-hover" id="tableText">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="checkAll"  id="checkAll"  />Check All <button type="submit" id="" class="label label-danger checkAllSubmit ">Delete</button></th>

                                <th>#</th>
                                <th>Category Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            <?php foreach ($service_provider_category as $each_data): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="delete" name="delete[]" value="<?php print $each_data['id']; ?>"  id="delete[]"/>
                                    </td>
                                    <td><?php print $cr; ?></td>
                                    <td><?php
                                        print $each_data['name'];
                                        ?></td>


                                    <td>

                                        <a href="javascript:void(0);" onclick="return DeleteServiceProviderCat('service_provider_cat/delete/<?php print $each_data['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                    </td>
                                </tr>
                                <?php $cr++; ?>    
                            <?php endforeach; ?>
                        </tbody>
                    </table></form>
            <?php else: ?>
                <div>No Service Provider Category Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>