<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Add New Users</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">First Name</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[user_fname]" id="user_fname" value="<?php print $user_fname; ?>" placeholder="First Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Last Name</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[user_lname]" id="user_lname" value="<?php print $user_lname; ?>" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">User Name</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[user_name]" id="user_name" value="<?php print $user_name; ?>" placeholder="User Name" required>
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-5">
                        <input  type="email" class="form-control"  placeholder="Email (admin@admin.com)" id="email" value="<?php print $email ?>" name="fields[email]" required />
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-5">
                        <input type="password" class="form-control"  id="password" autocomplete="off" name="fields[password]" placeholder="Password"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Phone Number</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[phone]" id="phone" value="<?php print $phone_val; ?>" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="form-group" >
                    <label for="inputUser" class="col-lg-2 control-label">Address</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[address]" id="address" value="<?php print $address_val; ?>" placeholder="Address" required>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="inputUser" class="col-lg-2 control-label">City</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[city]" id="city" value="<?php print $city_val; ?>" placeholder="City" required>
                    </div>
                </div>

                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">State</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[state]" id="state" value="<?php print $state_val; ?>" placeholder="State" required>
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Zipcode</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[zipcode]" id="zipcode" value="<?php print $zipcode_val; ?>" placeholder="Zipcode" required>
                    </div>
                </div>

                <div class="form-group"> 
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="fields[users_id]" id="users_id" value="<?php print $id_val; ?>">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>