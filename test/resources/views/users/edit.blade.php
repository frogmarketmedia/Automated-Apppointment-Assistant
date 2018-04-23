<form method="post" action="/user/{{$user->id}}/edit">
    {{ csrf_field() }}
    <input type="text" name="name"  value="{{ $user->name }}" />

    <input type="email" name="email"  value="{{ $user->email }}" />

    <input type="password" name="password" />

    <input type="password" name="password_confirmation" />

    <button type="submit">Send</button>
</form>
