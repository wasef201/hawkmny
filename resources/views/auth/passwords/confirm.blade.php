<x-auth-layout>
    <x-form class="w-100" action="{{route('password.confirm')}}">
        @csrf
        {{ __('Please confirm your password before continuing.') }}

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <x-slot name="submitBtn">
            <div class="text-center">
                <!--begin::Submit button-->
                <button type="submit" class="btn btn-success">
                    {{ __('Confirm Password') }}
                </button>
                <!--end::Submit button-->
            </div>
        </x-slot>
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </x-form>
</x-auth-layout>
