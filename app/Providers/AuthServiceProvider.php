<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
        ResetPassword::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('SISTEM ADUAN MODUL ORANG AWAM: RESET KATA LALUAN')
                ->line('Salam Sejahtera')
                ->line('')
                ->line('Log masuk untuk ke sistem Modul Orang Awam adalah seperti berikut :')
                ->line('Untuk tindakan selanjutnya, sila klik capaian ke Sistem MOA')
                ->action('Set Katalaluan', $url)
                ->line('Sekian, terima kasih.')
                ->line('')
                ->line('Perbadanan Pengurusan Sisa Pepejal & Pembersihan Awam (SWCorp)')
                ->line('Tel : 03-8312 4000 | Faks : 03-8312 4003')
                ->line('Web : http://www.swcorp.gov.my');
        });
    }
}
