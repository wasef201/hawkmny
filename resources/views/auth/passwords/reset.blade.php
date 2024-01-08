<x-auth-layout>
    <x-form action="{{ route('password.update') }}" class="w-100">

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="text-center mb-10">
            <h3>
                Reset Password

            </h3>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm"
                   class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                       required autocomplete="new-password">
            </div>
        </div>

        <x-slot name="submitBtn">
            <div class="text-center">
                <!--begin::Submit button-->
                <x-button type="submit" class="w-100 mb-5 btn btn-primary">Reset </x-button>
                <!--end::Submit button-->
            </div>
        </x-slot>
    </x-form>

</x-auth-layout>
