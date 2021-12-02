
<div id="update_frame">
  <div id="update_info" style="text-align: center;" ><h3>Update ToDo</h3> </div>
  <form class="note-form" action="{$path$}{$action$}" method="post">
    <div id="update_input" style="width: 695px; min-height: 20px;">

      <div id="update_title">
        <div>
          <div style="float: left; min-height: 20px; width: 150px; text-align: right; padding-right: 20px;">
            <label>Title<span class="required"></span></label>
          </div>
          <div style="float: left;">
            <input type="text" name="title" class="field-long" value="{$title_note$}" />
          </div>
          <div style="clear: both;"></div>
        </div>

      </div>
      <div style="height: 10px;"></div>

      <div id="update_deadline">
          <div style="float: left; min-height: 20px; width: 150px; text-align: right; padding-right: 20px;">
            <label>deadline:<span class="required"></span></label>
          </div>
          <div style="float: left;">
            <input type="date" name="deadline" class="field-long" value="{$deadline$}" />
          </div>
          <div style="clear: both;"></div>
      </div>

      <div style="height: 10px;"></div>

      <div id="update_descr">
          <div style="float: left; min-height: 20px; width: 150px; text-align: right; padding-right: 20px;">
            <label>Description</label>
          </div>
          <div style="float: left;">
            <textarea name="description" id="description" rows="6" cols="50">{$description_note$}</textarea>
          </div>
          <div style="clear: both;"></div>
      </div>
      <div style="height: 10px;"></div>

    </div>
    <div id="update_button" style="text-align: center;">
        <input type="hidden" name="button" id="button" value="update">
        <input type="hidden" name="update_note" id="update_note" value="{$id_note$}">
        <button class="btn btn-primary" type="submit">Update Note</button>
    </div>
  </form>
</div>
