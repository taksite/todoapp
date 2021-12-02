
<div id="create_frame">
  <div id="create_info" style="text-align: center;" ><h3>Create ToDo</h3> </div>
  <form class="note-form" action="{$path$}{$action$}" method="post">
    <div id="create_input" style="width: 695px; min-height: 20px;">

      <div id="create_title">
        <div>
          <div style="float: left; min-height: 20px; width: 150px; text-align: right; padding-right: 20px;">
            <label>Title<span class="required"></span></label>
          </div>
          <div style="float: left;">
            <input type="text" name="title" class="field-long" />
          </div>
          <div style="clear: both;"></div>
        </div>

      </div>
      <div style="height: 10px;"></div>

      <div id="create_deadline">
          <div style="float: left; min-height: 20px; width: 150px; text-align: right; padding-right: 20px;">
            <label>deadline:<span class="required"></span></label>
          </div>
          <div style="float: left;">
            <input type="date" name="deadline" class="field-long" value="{$deadline$}" />
          </div>
          <div style="clear: both;"></div>
      </div>

      <div style="height: 10px;"></div>

      <div id="create_descr">
          <div style="float: left; min-height: 20px; width: 150px; text-align: right; padding-right: 20px;">
            <label>Description</label>
          </div>
          <div style="float: left;">
            <textarea name="description" id="description" rows="6" cols="50"></textarea>
          </div>
          <div style="clear: both;"></div>
      </div>
      <div style="height: 10px;"></div>

    </div>
    <div id="create_button" style="text-align: center;">
          <input type="hidden" name="button" id="button" value="create">
          <button class="btn btn-primary" type="submit">Create Note</button>
    </div>
  </form>
</div>