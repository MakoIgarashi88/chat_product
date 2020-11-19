@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col cols="12">
            <h1 class="h4 text-center pt-8 font-weight-bold">
                新規登録
            </h1>
        </v-col>
    </v-row>
    <v-row justify="center">
        <v-col cols="12" sm="8" md="6">
            <v-card>
                <v-card-text>
                    <form method="post" action="{{ route('register') }}">
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
                        <v-row class="pt-3">
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
                                    autocomplete="new-password"
                                    class="pb-0"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="pt-3">
                            <v-col cols="12">
                                <v-text-field
                                    label="パスワード確認"
                                    outlined
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    class="pb-0"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="pt-3">
                            <v-col cols="12">
                                <v-text-field
                                    label="ニックネーム"
                                    outlined
                                    type="text"
                                    name="nickname"
                                    value="{{ old('nickname') }}"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <div class="form-group row">
                            <div class="col-12">
                                <v-btn type="submit" color="secondary" block large>
                                    新規登録
                                </v-btn>
                            </div>
                        </div>
                    </form>
                </v-card-text>
            </v-card>
            <!-- <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="h">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control @error('name') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                                @error('nickname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
        </v-col>
    </v-row>
</v-container>
@endsection
