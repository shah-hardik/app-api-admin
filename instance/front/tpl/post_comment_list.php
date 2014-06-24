<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Post Comment</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($post_comment)):
                ?>
                <form method="post" class="form-horizontal" role="form" >

                    <table class="table table-hover" id="tableText">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="checkAll"  id="checkAll"  />Check All <button type="submit" id="" class="label label-danger checkAllSubmit ">Delete</button></th>

                                <th>#</th>
                                <th>Post Type</th>
                                <th>User Name</th>
                                <th>Comment</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="">
                            <?php foreach ($post_comment as $each_post): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="delete" name="delete[]" value="<?php print $each_post['id']; ?>"  id="delete[]"/>
                                    </td>
                                    <td><?php print $cr; ?></td>
                                    <td><?php
                                        $post = qs("select * from post where id='{$each_post['post_id']}'");
                                        print $post['type'];
                                        ?></td>

                                    <td><?php
                                        $user = qs("select * from user where id='{$each_post['user_id']}'");
                                        print $user['first_name'];
                                        ?></td>
                                    <td><?php print $each_post['comment']; ?></td>


                                    <td>
                                        <a href="javascript:void(0);" onclick="return DeletePostComment('post_comment/delete/<?php print $each_post['id']; ?>')"><i class="glyphicon glyphicon-trash" title="Delete"></i></a>
                                    </td>
                                </tr>
                                <?php $cr++; ?>    
                            <?php endforeach; ?>
                        </tbody>
                    </table></form>
            <?php else: ?>
                <div>No Post Comment Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>