@component('mail::message')
# Introduction

The body of your message.
Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos fuga est nulla laudantium repudiandae cupiditate voluptatibus ratione modi deleniti deserunt labore officiis molestias voluptatum quod maxime fugiat, nam placeat. Debitis nulla ipsum atque culpa reiciendis, id molestias rem nam exercitationem! Lorem ipsum

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
