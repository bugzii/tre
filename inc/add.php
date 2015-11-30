<form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="character" class="col-sm-3 control-label">Character</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="character" name="character" placeholder="Your characters name">
    </div>
  </div>
  <div class="form-group">
    <label for="wztype" class="col-sm-3 control-label">Warzone type</label>
    <div class="col-sm-9">
	    <select class="form-control" id="wztype" name="wztype">
		    <option value="">Warzone or Arena?
		    <option value="warzone">Warzone
		    <option value="arena">Arena
	    </select>
    </div>
  </div>
  <div class="form-group">
    <label for="faction" class="col-sm-3 control-label">Faction</label>
    <div class="col-sm-9">
	    <select class="form-control" id="faction" name="faction">
		    <option value="">Which faction?
		    <option value="imp">Imperial
		    <option value="rep">Republic
	    </select>
    </div>
  </div>
  <div class="form-group">
    <label for="class" class="col-sm-3 control-label">Class</label>
    <div class="col-sm-9">
	    <select class="form-control" id="class" name="class">
		    <option value="">What class?
		    <?
		    	foreach($classes as $key => $values)
			{
				echo "<option value='$key'>".$values[0]." / ".$values[1];
			}
		    ?>
	    </select>
    </div>
  </div>
  <div class="form-group">
    <label for="type" class="col-sm-3 control-label">Record type</label>
    <div class="col-sm-9">
	    <select class="form-control" id="type" name="type">
		<option value=""></option>
		    <?
		    foreach($headers as $key=>$value)
		    {
		    	echo "<option value='$key'>$value";
		    }
		    ?>
	    </select>
    </div>
  </div>
  <div class="form-group">
    <label for="amount" class="col-sm-3 control-label">Amount</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="amount" name="amount" placeholder="How big is your epeen?">
    </div>
  </div>
  <div class="form-group">
    <label for="url" class="col-sm-3 control-label">Screenshot</label>
    <div class="col-sm-9">
	    <input type="url" class="form-control" id="url" name="url" placeholder="Link to proof (direct img link to imgur)">
	    <span class="help-block">Examples: <br>http://i.imgur.com/1WfKCBo.jpg</span>
	    <span class="help-block">http://assets-cloud.enjin.com/users/2548072/pics/original/3009192.jpg</span>
    </div>
  </div>
  <div class="form-group">
    <label for="patch" class="col-sm-3 control-label">Patch</label>
    <div class="col-sm-9">
	    <select class="form-control" id="patch" name="patch">
		    <option value="3.0">Patch number? (defaults to 3.0)
		    <option value="2.0">2.0-2.3
		    <option value="2.4">2.4-2.10
		    <option value="3.0">3.0
	    </select>
    </div>
  </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" id="captchaOperation"></label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="captcha" id="captcha" />
        </div>
    </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-primary">Send for approval</button>
    </div>
  </div>
</form>
