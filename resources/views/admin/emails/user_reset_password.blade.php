@component('mail::message')
# Reset Acount

Welcom {{$data['user']->name}} 

@component('mail::button', ['url' => uurl('reset/password/'.$data['token']), 'class' => "btn btn-primary"])
{{trans('admin.reset_user_pass')}}
<br> 
@endcomponent
# {{trans('admin.or_Copy_This_link')}}<br>
 <a href="{{uurl('reset/password/'.$data['token'])}}">{{aurl('reset/password/'.$data['token'])}}</a>
Thanks,<br>
{{ Config('app.name')}}
@endcomponent
