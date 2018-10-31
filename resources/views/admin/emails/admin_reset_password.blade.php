@component('mail::message')
# Reset Acount

Welcom {{$data['admin']->name}} 

@component('mail::button', ['url' => aurl('reset/password/'.$data['token']), 'class' => "btn btn-primary"])
{{trans('admin.reset_admin_pass')}}
<br> 
@endcomponent
# {{trans('admin.or_Copy_This_link')}}<br>
 <a href="{{aurl('reset/password/'.$data['token'])}}">{{aurl('reset/password/'.$data['token'])}}</a>
Thanks,<br>
{{ Config('app.name')}}
@endcomponent
