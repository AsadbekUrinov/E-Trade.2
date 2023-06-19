<form method="post" action="{{action('App\Http\Controllers\Admin\SettingsController@updatesubfee')}}">
    <div class="Form-group">
        <h4 class="text-{{$text}}">Monthly Subscription Fee:</h4>
        <input type="text" name="monthlyfee" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" value="{{$settings->monthlyfee}}">
    </div>

    <div class="form-group">
        <h4 class="text-{{$text}}">Quaterly Subscription Fee:</h4>
        <input type="text" name="quaterlyfee" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}"  value="{{$settings->quarterlyfee}}">
    </div>
    
    <div class="form-group">
        <h4 class="text-{{$text}}">Yearly Subscription Fee:</h4>
        <input type="text" name="yearlyfee" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}"  value="{{$settings->yearlyfee}}">
    </div>

    <input type="submit" class="px-5 btn btn-primary btn-round btn-lg" value="Save">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"><br/>
</form>