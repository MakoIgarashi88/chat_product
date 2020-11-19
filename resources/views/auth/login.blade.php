@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col cols="12" class="pb-0">
            <h1 class="h4 text-center pt-8 font-weight-bold">
                ログイン
            </h1>
        </v-col>
    </v-row>
    <v-row justify="center">
        <v-col cols="12" sm="8" md="6">
            <v-card>
                <v-card-text>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <v-row class="pt-3">
                            <v-col cols="12">
                                <v-text-field
                                    label="ユーザーID"
                                    outlined
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    v-bind:error="@error('name') true @else false @enderror"
                                    error-messages="@error('name') {{$message}} @enderror"
                                    required
                                    autocomplete="name"
                                    autofocus
                                    class="pb-0"
                            ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    label="パスワード"
                                    outlined
                                    type="password"
                                    name="password"
                                    value="{{ old('password') }}"
                                    v-bind:error="@error('password') true @else false @enderror"
                                    error-messages="@error('password') {{$message}} @enderror"
                                    required
                                    autocomplete="password"
                            ></v-text-field>
                            </v-col>
                        </v-row>

                        <div class="form-group row justify-center">
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        ログイン状態を保存
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <v-btn type="submit" color="secondary" elevation="0" block large>
                                    {{ __('Login') }}
                                </v-btn>
                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</v-container>
@endsection
