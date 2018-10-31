@component('mail::message')
# Reset Acount

Welcom {{$data['name']}} 
<br>

<center> <span><p> {{$data['message']}} </p></span> </center>
<hr>
@component('mail::button', ['url' => url('/medicare/public'), 'class' => "btn btn-primary"])
{{trans('admin.visit_us')}}
<br> 
@endcomponent
# {{trans('admin.thank')}}
Thanks,<br>
{{ session('lang') == 'ar'?settings()->sitename_ar:settings()->sitename_en}}
@endcomponent
