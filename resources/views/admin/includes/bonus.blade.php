<form method="post" action="{{action('App\Http\Controllers\Admin\SettingsController@updatebotswt')}}" enctype="multipart/form-data">

    <div class="form-group">
        <label for=""></label>
    <h5 class="text-{{$text}}">Direct Referral Commission (%) </h5>
        <input type="text" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="ref_commission" value="{{$settings->referral_commission}}" required>
    </div>

    <div class="form-group">
        <h5 class="text-{{$text}}">Indirect Referral Commission 1 (%) </h5>
        <input type="text" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="ref_commission1" value="{{$settings->referral_commission1}}" required>
    </div>

    <div class="form-group">
        <h5 class="text-{{$text}}">Indirect Referral Commission 2 (%) </h5>
        <input type="text" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="ref_commission2" value="{{$settings->referral_commission2}}" required>
    </div>

    <div class="form-group">
        <h5 class="text-{{$text}}">Indirect Referral Commission 3 (%) </h5>
        <input type="text" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="ref_commission3" value="{{$settings->referral_commission3}}" required>
    </div>

    <div class="form-group">
        <h5 class="text-{{$text}}">Indirect Referral Commission 4 (%) </h5>
        <input type="text" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="ref_commission4" value="{{$settings->referral_commission4}}" required>
    </div>

    <div class="form-group">
        <h5 class="text-{{$text}}">Indirect Referral Commission 5 (%) </h5>
        <input type="text" class="form-control  bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="ref_commission5" value="{{$settings->referral_commission5}}" required>
    </div>

    <div class="form-group">
        <h5 class="text-{{$text}}">Registration Bonus({{$settings->currency}})</h5>
        <input type="text" class="form-control bg-{{Auth('admin')->User()->dashboard_style}} text-{{$text}}" name="signup_bonus" value="{{$settings->signup_bonus}}" required>
    </div>

    <input type="submit" class="px-5 btn btn-primary btn-lg" value="Update">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"><br/>
</form>