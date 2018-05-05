@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="/user/{{$user->id}}/edit">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}"  required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                            <div class="col-md-6">
                                <input id="profession" type="text" class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" name="profession" value="{{ $user->profession }}" required autofocus>

                                @if ($errors->has('profession'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <?php
                        $i=0;
                        ?>
                        @foreach($education as $vedu)
                        <?php
                            $i++;
                            if($vedu->present)
                                $curr="True";
                            else
                                $curr="False"; 
                        ?>
                        <input type="hidden" name="eduid[]" value="{{$vedu->id}}">
                        <div class="form-group row">
                            <label for="institution" class="col-md-4 col-form-label text-md-right">{{ __('Institution ')}}{{$i}}</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('institution') ? ' is-invalid' : '' }}" id="institution" type="text"  name="institution[]" value="{{ $vedu->institution }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" id="department" type="text"  name="department[]" value="{{ $vedu->department }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="degree" class="col-md-4 col-form-label text-md-right">{{ __('Degree') }}</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('degree') ? ' is-invalid' : '' }}" id="degree[]" type="text"  name="degree" value="{{ $vedu->degree }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="present" class="col-md-4 col-form-label text-md-right">{{ __('Current Institution') }}</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('present') ? ' is-invalid' : '' }}" id="present" type="text"  name="present[]" value="{{ $curr }}" required autofocus>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Add More Educational Background') }}</label>

                            <div class="col-md-6">
                                <a href="/user/{{ $user->id }}/edit/editeducation">
                                    <button type="button" style="font-size: 20px"><i class="fa fa-pencil"></i></button>
                                </a>
                            </div>
                        </div>
                        <?php
                        $i=0;
                        ?>
                        @foreach($experience as $experience)
                        <?php
                            $i++;
                            if($experience->present)
                                $curr="True";
                            else
                                $curr="False"; 
                        ?>
                        <input type="hidden" name="exid[]" value="{{$experience->id}}">
                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company ') }}{{$i}}</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" id="company" type="text"  name="company[]" value="{{ $experience->work_place }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" id="designation" type="text"  name="designation[]" value="{{ $experience->designation }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="presentex" class="col-md-4 col-form-label text-md-right">{{ __('Current Work Place') }}</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('present') ? ' is-invalid' : '' }}" id="presentex" type="text"  name="presentex[]" value="{{ $curr }}" required autofocus>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Add More Work Experience') }}</label>

                            <div class="col-md-6">
                                <a href="/user/{{ $user->id }}/edit/editexperience">
                                    <button type="button" style="font-size: 20px"><i class="fa fa-pencil"></i></button>
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
