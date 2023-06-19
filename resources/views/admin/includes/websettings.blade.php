<form method="post" action="{{action('App\Http\Controllers\Admin\SettingsController@updatepreference')}}" enctype="multipart/form-data">
    <div class="form-group">
        <h5 class="text-{{$text}}">Contact Email</h5>
        <input type="text" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="contact_email" value="{{$settings->contact_email}}" required>
    </div>
    <div class="form-group">
        <h5 class="text-{{$text}}">Uploaded Files Location</h5>
        <small class="text-{{$text}}">Note: To use AWS S3, please supply your AWS information in the .ENV file</small> 
        <select name="location" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}">
            <option>{{$settings->location}}</option> 
            <option>AWS S3</option> 
            <option>Email</option>
            <option>Local</option>
        </select><br/> 
    </div>
    <input name="s_currency" value="{{ $settings->s_currency }}" id="s_c" type="hidden">
    <div class="form-group">
        <h5 class="text-{{$text}}">Website Currency</h5>
		<select name="currency" id="select_c" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" onchange="s_f()">
            <option value="<?php echo htmlentities($settings->currency); ?>">{{ $settings->currency }}</option>
            @foreach($currencies as $key=>$currency)
            <option id="{{$key}}" value="<?php echo html_entity_decode($currency); ?>">{{$key .' ('.html_entity_decode($currency).')'}}</option>
            @endforeach
		</select>
	</div>

    <script>
        function s_f(){
            var e = document.getElementById("select_c");
            var selected = e.options[e.selectedIndex].id;
            document.getElementById("s_c").value = selected;
        }
    </script>

    <input type="hidden" value="{{$settings->site_preference}}" name="site_preference">

    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="text-{{$text}}">Turn off/on Annoucment: </h5>
            </div>
            <div class="sign-up2">
            <label class="switch">
                <input name="annouc" id="annouc" type="checkbox" value="on">
                <span class="slider round"></span>
            </label>
            </div>
        </div> 
    </div>
    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="text-{{$text}}">Turn off/on Weekend Trade:</h5>
            </div>
            <div class="sign-up2">
                <small class="text-{{$text}}">if turned off, Users will not receive ROI on weekends</small> <br>
            <label class="switch">
                <input name="weekend_trade" id="weekend_trade" type="checkbox" value="true">
                <span class="slider round"></span>
            </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="text-{{$text}}"> Disable/Enable Withdrawal:</h5>
            </div>
            <div class="sign-up2">
                <small class="text-{{$text}}">if turned on, Users will not be able to Withdraw</small> <br>
            <label class="switch">
                <input name="withdraw" id="withdraw" type="checkbox" value="true">
                <span class="slider round"></span>
            </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="text-{{$text}}">Turn off/on Google Translate</h5>
            </div>
            <div class="sign-up2">
                <small class="text-{{$text}}">if turned on, Users will have the option of changing their language through google translate.</small> <br>
            <label class="switch">
                <input name="googlet" id="googlet" type="checkbox" value="on">
                <span class="slider round"></span>
            </label>
            </div>
        </div>
    </div>
     <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h5 class="text-{{$text}}">Turn off/on trade: </h5>
            </div>
            <div class="sign-up2">
            <label class="switch">
                <input name="trade_mode" id="check" type="checkbox" value="on">
                <span class="slider round"></span>
            </label>
            </div>
        </div> 
    </div>
    
    <div class="form-group">
        <div class="sign-u">
        <div class="sign-up1">
            <h5 class="text-{{$text}}">Turn off/on KYC:</h5>
        </div>
        <div class="sign-up2">
            <label class="switch">
                <input name="enable_kyc" id="kyc_check" type="checkbox" value="yes">
                <span class="slider round"></span>
            </label>
        </div>
        </div>
    </div>

    @if($settings->enable_annoc=='on')
    <script>document.getElementById("annouc").checked= true;</script>
    @endif

    @if($settings->google_translate=='on')
    <script>document.getElementById("googlet").checked= true;</script>
    @endif

    @if($settings->trade_mode=='on')
        <script>document.getElementById("check").checked= true;</script>
    @endif

    @if($settings->enable_kyc=='yes')
        <script>document.getElementById("kyc_check").checked= true;</script>
    @endif

    @if($settings->weekend_trade=='true')
        <script>document.getElementById("weekend_trade").checked= true;</script>
    @endif

    @if($settings->enable_with=='true')
        <script>document.getElementById("withdraw").checked= true;</script>
    @endif

     <input type="submit" class="px-5 mb-2 btn btn-primary btn-lg" value="Save">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"><br/>
</form>