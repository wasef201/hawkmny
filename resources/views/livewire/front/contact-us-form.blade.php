<x-form wire:submit.prevent="submit" class="mt-6">
    <x-tailwind.form-input wire-modifier=".defer" class="input" label="{{__('front.name')}}"
                           name="name" placeholder="مثال : عمر عبدالرازق محمود الجعبري"></x-tailwind.form-input>

    <x-tailwind.form-input wire-modifier=".defer" type="email" placeholder="مثال : hukamin53@gmail.com" class="input" label="{{__('front.email')}}"
                           name="email"></x-tailwind.form-input>

    <x-tailwind.form-input wire-modifier=".defer" class="input" name="phone" label="{{__('front.phone')}}"
                           placeholder="مثال : 665203335"></x-tailwind.form-input>

    <x-tailwind.form-input wire-modifier=".defer" class="input" name="subject" label="{{__('front.subject')}}"
                           placeholder="{{__('front.subject')}}"></x-tailwind.form-input>

    <div class="mb-0 col-span-2">
        <x-tailwind.form-textarea label="{{__('front.message')}}" wire-modifier=".defer" rows="4" class="input"
                                  name="message" placeholder="مثال : أريد الإستفسار عن شئ ما بخصوص منصة حوكمني"></x-tailwind.form-textarea>
    </div>
    <div class="col-span-2 flex place-content-end">
        <x-slot name="submitBtn">
            <div>

                <button class="btn block w-full bg-themegreen text-white text-center mx-0 my-4 ">
                    {{__('front.send_message')}}

                </button>
            </div>

        </x-slot>

    </div>

</x-form>
