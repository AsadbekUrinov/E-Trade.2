<form method="post" action="{{action('App\Http\Controllers\Admin\SettingsController@updatebot')}}" enctype="multipart/form-data">
    <div class="form-group">
        <h5 class="text-{{$text}}">Bot Link</h5>
        <input type="text" name="bot_link" value="{{$settings->bot_link}}" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}">
    </div>
    <div class="form-group">
        <h5 class="text-{{$text}}">Telegram Token</h5>
        <input type="text" name="telegram_token" value="{{$settings->telegram_token}}" class="form-control  bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" >
    </div>
    <div class="form-group">
        <h5 class="text-{{$text}}">Bot group chat link</h5>
        <input type="text" name="bot_group_chat" value="{{$settings->bot_group_chat}}" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}">
    </div>

    <div class="form-group">
        <label for=""></label>
        <h5 class="text-{{$text}}">Bot channel link</h5>
        <input type="text" name="bot_channel" value="{{$settings->bot_channel}}" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}">
    </div>
    
    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h4></h4>
                <h5 class="text-{{$text}}">Activate/Deactivate bot:</h5>
            </div>
            <div class="sign-up2">
            <label class="switch">
            <input type="checkbox" id="bot_activate" name="bot_activate" value="true">
            <span class="slider round"></span>
            </label>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
<input type="submit" class="px-5 btn btn-primary btn-lg" value="Save">
<input type="hidden" name="id" value="1">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>