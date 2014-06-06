<div class="addAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">Edit New Neighborhood</div>
        <div class="panel-body">
            <form method="post" action="" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[name]" id="name" value="<?php print $name; ?>" placeholder="First Name" required>
                    </div>
                </div>
                 <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Location </label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Location " id="location"  name="fields[location]" value="<?php print $locations ?>" required />
                    </div>
                </div>
                <div class="form-group " >
                    <label for="inputUser" class="col-lg-2 control-label">Location Latitude</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" placeholder="Location Latitude" id="latitude"  name="fields[latitude]" value="<?php print $latitude ?>" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUser" class="col-lg-2 control-label">Location Longitude</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="fields[longitude]" id="longitude" value="<?php print $longitude; ?>" placeholder="Location Longitude" required>
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