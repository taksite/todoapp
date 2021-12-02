<div id="note_frame" style="width: 790px; margin-left: auto; margin-right: auto;">

    <div id="note_data" style="float: left;"> 
        <div id="note_title" style="width: 695px; min-height: 20px; border: 1px dotted #751b1b; border-radius: 3px;"> {$title$}</div>
        <div id="note_deadline" style="width: 695px;min-height: 20px;"> Deadline: <b>{$deadline$}</b></div>
        <div id="note_dscr" style="width: 695px; min-height: 20px;">{$description$}</div>
    </div>

    <div id="note_button" style="float: left;"> 

        <div id="note_btn_update" style="width: 76px; height: 40px; padding-left: 5px;">
            <a href="{$path$}{$action$}?page=update&id_note={$id_note$}">
                <button class="upd">Update</button>
            </a>
        </div>
        <div id="note_btn_delete" style="width: 76px; height: 40px; padding-left: 5px;">
            <a href="{$path$}{$action$}?page=delete&id_note={$id_note$}">
                <button class="dlt">Delete</button>
            </a>
        </div>

    </div>
    <div style="clear: both;"></div>
    <div style="height: 10px;"></div>
</div>
<div style="height: 10px;"></div>
