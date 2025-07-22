<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Article;
use App\Mail\WeeklyNewsletterMail;

class SendWeeklyNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:weekly-newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim newsletter mingguan ke semua pengguna';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("=== Mulai kirim Weekly Newsletter ===");

        $users = User::whereNotNull('email')->get();
        $articles = Article::latest()->take(3)->get();

        if ($users->isEmpty()) {
            Log::warning("Tidak ada user dengan email untuk dikirimi newsletter.");
            return;
        }

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new WeeklyNewsletterMail($user, $articles));
                Log::info("Newsletter berhasil dikirim ke: " . $user->email);
            } catch (\Exception $e) {
                Log::error("Gagal mengirim ke {$user->email}: " . $e->getMessage());
            }
        }

        Log::info("=== Newsletter selesai dikirim ke " . $users->count() . " pengguna ===");
        Log::info("Newsletter sent to " . $users->count() . " users.");
    }
}
