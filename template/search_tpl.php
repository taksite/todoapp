

<div id="search_frame">
  <div id="search_info" style="text-align: center;" ></div>
  <form class="note-form" action="{$path$}{$action$}" method="post">
    <div id="search_input" style="width: 695px; min-height: 20px;">

      <div id="search_title" style="padding-left: 25px;">
        <div>
          <div style="float: left; min-height: 20px; width: 150px; text-align: right; padding-right: 20px;">
            <label><span class="required"></span></label>
          </div>
          <div style="float: left; padding-left: 25px;">
            <input type="text" name="search" class="field-long" />
          </div>
          <div style="clear: both;"></div>
        </div>

    </div>
    <div id="update_button" style="text-align: center; padding-left: 35px;">
        <input type="hidden" name="button" id="button" value="search">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
  </form>
</div>