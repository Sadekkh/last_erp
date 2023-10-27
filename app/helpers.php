    <?php

    use Illuminate\Support\Facades\App;

    function localePrefix()
    {
        return (App::getLocale() == 'ar') ? '_ar' : '_en';
    }
