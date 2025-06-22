<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:generate-token {username}';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an API token for a user and store it in the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $user = User::where('username', $this->argument('username'))->firstOrFail();
        
        // Generate a token with a hashed name (cache-friendly)
        $tokenName = 'api-token-' . now()->timestamp;
        $token = $user->createToken($tokenName)->plainTextToken;
        
        $this->info("API Token generated successfully!");
        $this->line("Token: " . $token);
        
        // Optionally, store the token in a cache for faster retrieval
        // $cacheKey = 'user_token_' . $user->id;
        // cache()->put($cacheKey, $token, now()->addDays(30));
        
        return 0;
    }
}
