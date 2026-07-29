<?php

declare(strict_types=1);

namespace App\Bootstrap;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPAuth\Auth as PHPAuth;
use PHPAuth\Config;

class Auth
{
    private static ?PHPAuth $instance = null;

    public static function instance(): PHPAuth
    {
        if (self::$instance === null) {
            DatabaseManager::boot();
            $pdo = Capsule::connection()->getPdo();

            $config = new Config($pdo, [
                'table_users'    => 'users',
                'table_sessions' => 'phpauth_sessions',
                'table_attempts' => 'phpauth_attempts',
                'table_requests' => 'phpauth_requests',
                'bcrypt_cost'       => 10,
                'site_name'         => 'Activity Log',
                'site_url'          => 'http://localhost:8080',
                'site_email'        => 'noreply@activitylog.local',
                'site_key'          => 'fghuior.)/!/jdUkd8s2!7HVHG7777ghg',
                'site_timezone'     => 'UTC',
                'cookie_name'       => 'activity_log_session',
                'cookie_forget'     => '+30 minutes',
                'cookie_remember'   => '+1 month',
                'cookie_renew'      => '+5 minutes',
                'cookie_secure'     => 0,
                'cookie_http'       => 1,
                'cookie_path'       => '/',
                'uses_session'      => 1,
                'allow_concurrent_sessions' => 1,
                'verify_email_min_length'   => 5,
                'verify_email_max_length'   => 100,
                'verify_password_min_length' => 3,
                'attempts_before_ban'       => 30,
                'attempts_before_verify'    => 5,
                'attack_mitigation_time'    => '+30 minutes',
                'translation_source' => 'php',
                'emailmessage_suppress_activation' => 1,
                'emailmessage_suppress_reset' => 1,
            ], 'array');

            self::$instance = new PHPAuth($pdo, $config);
        }

        return self::$instance;
    }
}
