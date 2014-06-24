<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Alerts</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($alerts)):
                ?>
                <form method="post" class="form-horizontal" role="form" >

                    <table class="table table-hover" id="tableText" >
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="checkAll"  id="checkAll"  />Check All <button type="submit" id="" class="label label-danger checkAllSubmit ">Delete</button></th>

                                <th>#</th>
                                <th>User Name</th>
                                <th>type</th>

                                <th>Alert</th>

                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            <?php foreach ($alerts as $each_data): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="delete" name="delete[]" value="<?php print $each_data['id']; ?>"  id="delete[]"/>
                                    </td>
                                    <td><?php print $cr; ?></td>
                                    <td><?php
                                        $user = qs("SELECT * FROM user where id ='{$each_data['user_id']}'");
                                        print $user['first_name'];
                                        ?></td>

                                    <td><?php
                                        print $each_data['type'];
                                        ?></td>
                                    <td><?php print $each_data['alert']; ?></td>

                                    <td>
                                        <a href="<?php print _U ?>alerts/edit/<?php print $each_data['id']; ?>"><i class="glyphicon glyphicon-edit" title="Edit"></i></a>
                                        <a href="javascript:void(0);" on onclick="return DeleteAlerts('alerts/delete/<?php print $each_data['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                    </td>
                                </tr>
                                <?php $cr++; ?>    
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
                <?php else: ?>
                    <div>No Alerts Available</div>
                <?php endif; ?>
        </div>
    </div>
</div>