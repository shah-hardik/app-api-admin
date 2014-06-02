<div class="col-md-12 col-lg-12 ">

    <div class="panel panel-default ">
        <div class="panel-heading">
            <div style=""><b>List of Users</b></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($users)):
                ?>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        <?php foreach ($users as $each_user): ?>
                            <tr>
                                <td><?php print $cr; ?></td>
                                <td><?php print $each_user['first_name']; ?></td>
                                <td><?php print $each_user['last_name']; ?></td>
                                <td><?php print $each_user['email']; ?></td>
                                <td><?php print $each_user['username']; ?></td>
                            </tr>
                            <?php $cr++; ?>    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div>No User Available</div>
            <?php endif; ?>
        </div>
    </div>
</div>