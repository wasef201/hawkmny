<x-panel title="اعدادات النظام">
    <x-form action="{{ route('settings.store') }}" submit-text="حفظ الاعدادات">
        <div class="row">
            <x-form.input name="title" col="col-12 col-md-6" label="اسم المنصة" value="{{ general_setting()->title }}" required/>
            <x-form.input name="email" col="col-12 col-md-6" label="البريد الالكتروني لاستقبال التنبيهات" value="{{ general_setting()->email }}" />
            <x-form.input.check-box name="login_status" :checked="general_setting()->login_status" col="col-12 col-md-3" label="اتاحة عملية تسجيل الدخول"/>
            <x-form.textarea col="col-12 col-md-9" name="login_close_message" label="رسالة الاغلاق">{{ general_setting()->login_close_message }}</x-form.textarea>
            <x-form.input.check-box name="register_status" :checked="general_setting()->register_status" col="col-12 col-md-3" label="اتاحة عملية التسجيل"/>
            <x-form.textarea col="col-12 col-md-9" name="register_close_message" label="رسالة الاغلاق">{{ general_setting()->register_close_message }}</x-form.textarea>
            <hr>
            <h2>اعدادات الموقع</h2>
            <x-form.textarea col="col-12 col-md-9" name="who_us_description" label="وصف من نحن">{{ general_setting()->who_us_description }}</x-form.textarea>
            <x-form.textarea col="col-12 col-md-9" name="haokmny_advantages_description" label="وصف مميزات حوكمني">{{ general_setting()->haokmny_advantages_description }}</x-form.textarea>
            <x-form.textarea col="col-12 col-md-9" name="partners_description" label="وصف شركاء ألنجاح">{{ general_setting()->partners_description }}</x-form.textarea>
            <x-form.textarea col="col-12 col-md-9" name="how_subscribe_description" label="وصف  كيفية الاشتراك ">{{ general_setting()->how_subscribe_description }}</x-form.textarea>
            <x-form.textarea col="col-12 col-md-9" name="contact_us_description" label="وصف   تواصل معنا ">{{ general_setting()->contact_us_description }}</x-form.textarea>
            <x-form.textarea col="col-12 col-md-9" name="social_description" label="وصف وسائل التواصل">{{ general_setting()->social_description }}</x-form.textarea>

            <x-form.input name="site_phone" col="col-12 col-md-6" label="جوال الموقع" value="{{ general_setting()->site_phone }}" required/>
            <x-form.input name="site_email" col="col-12 col-md-6" label="ايميل الموقع" value="{{ general_setting()->site_email }}" required/>
            <x-form.input name="site_location" col="col-12 col-md-6" label="اللوكيشن" value="{{ general_setting()->site_location }}" required/>
{{--            <x-form.input name="title" col="col-12 col-md-6" label="لينك اللوكيشن" value="{{ general_setting()->title }}" required/>--}}

            <x-form.input name="facebook_link" col="col-12 col-md-6" label="لينك فيسبوك" value="{{ general_setting()->facebook_link }}" required/>
            <x-form.input name="tweeter_link" col="col-12 col-md-6" label="لينك تويتر" value="{{ general_setting()->tweeter_link }}" required/>
            <x-form.input name="instagram_link" col="col-12 col-md-6" label="لينك انستجرام" value="{{ general_setting()->instagram_link }}" required/>
            <x-form.input name="linkedin_link" col="col-12 col-md-6" label="لينك لينكدان" value="{{ general_setting()->linkedin_link }}" required/>

            <hr>
            <x-form.input name="associations_title" col="col-12 col-md-6" label="عنوان الجمعيات" value="{{ general_setting()->associations_title }}" required/>
            <x-form.input name="associations_description" col="col-12 col-md-6" label="وصف الجمعيات" value="{{ general_setting()->associations_description }}" required/>
            <hr>
        </div>
    </x-form>
</x-panel>
