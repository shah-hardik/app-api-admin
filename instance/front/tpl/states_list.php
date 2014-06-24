<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of States</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($state)):
                ?>
                <form method="post" class="form-horizontal" role="form" >

                    <table class="table table-hover" id="tableText" >
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="checkAll"  id="checkAll"  />Check All <button type="submit" id="" class="label label-danger checkAllSubmit ">Delete</button></th>

                                <th>#</th>
                                <th>No of Post</th>
                                <th>No of  Neighborhoods</th>
                                <th>No of  Neighbor</th>
                                <th>No of list</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            <?php foreach ($state as $each_data): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="delete" name="delete[]" value="<?php print $each_data['user_id']; ?>"  id="delete[]"/>
                                    </td>
                                    <td><?php print $cr; ?></td>
                                    <td><?php
                                        print $each_data['posts_count'];
                                        ?></td>
                                    <td><?php print $each_data['neighborhoods_count']; ?></td>
                                    <td><?php print $each_data['neighbors_count']; ?></td>
                                    <td><?php print $each_data['lists_count']; ?></td>


                                    <td>
                                        <a href="<?php print _U ?>states/edit/<?php print $each_data['user_id']; ?>"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
                                        <a href="javascript:void(0);" onclick="return DeleteState('states/delete/<?php print $each_data['user_id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                    </td>
                                </tr>
                                <?php $cr++; ?>    
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            <?php else: ?>
                <div>No States Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>