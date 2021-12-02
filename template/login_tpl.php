<div id="login" style="margin-top: 25px; width: 700px; margin-left: auto; margin-right: auto;"> 
    <div>
        <form action="{$path$}{$action$}" method="POST">
            <div style="margin-left: auto; margin-right: auto; width: 690px;">
                <div style="float: left; width: 270px; text-align: right; padding-right: 20px;"> user name: </div> 
                <div style="float: left; width: 300px;"> <input type="text" name="user" id="user" value="{$value_user$}" /> </div>
                <div style="clear: both; text-align: center; color: red; height: 30px;"> {$info_user$} </div>
            </div>

            <div style="margin-left: auto; margin-right: auto; width: 690px;">       
                <div style="float: left; width: 270px; text-align: right; padding-right: 20px;"> password: </div> 
                <div style="float: left; width: 300px;"> <input type="password" name="password" id="password" value="{$value_password$}" /> </div>
                <div style="clear: both; text-align: center; color: red; height: 30px;"> {$info_password$} </div>
            </div>

            <div style="margin-left: auto; margin-right: auto; width: 690px; text-align: center;">    
            <input type="hidden" name="button" id="button" value="logon">
            <button class="btn btn-primary" type="submit">Login</button>        
            </div>
        </form>
    </div>
</div>
