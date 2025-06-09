<?php

namespace Database\Seeders;

use App\Models\FreeApp;
use Illuminate\Database\Seeder;

class FreeAppSeeder extends Seeder
{
    public function run()
    {
        $apps = [
            [
                'name' => 'Inshot Premium',
                'category' => 'Video Editing',
                'description' => 'Premium video editing app.',
                'external_link' => 'https://files.modyolo.com/InShot/InShot%20Pro%20v2.625.3065%20Mod.apk',
                'image' => 'inshot.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'ExpressVPN',
                'category' => 'VPN',
                'description' => 'Secure VPN service.',
                'external_link' => 'https://files.modyolo.com/ExpressVPN/ExpressVPN_v11.97.0.xapk',
                'image' => 'express.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'WhatsApp Ban_Unban',
                'category' => 'Messaging',
                'description' => 'Tool to manage WhatsApp bans.',
                'external_link' => '#',
                'image' => 'WABan.jpg',
                'downloads_count' => 0,
                'status' => 'pending',
            ],
            [
                'name' => 'Telegram Premium',
                'category' => 'Messaging',
                'description' => 'Premium messaging app.',
                'external_link' => 'https://files.modyolo.com/Telegram/Telegram%20Premium%20v11.12.0.apk',
                'image' => 'telegram.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'GB WhatsApp',
                'category' => 'Messaging',
                'description' => 'Modified WhatsApp with extra features.',
                'external_link' => 'https://files.modyolo.com/GBWhatsApp/GBWhatsApp%20v17.20%20[Official].apk',
                'image' => 'GBWhatsApp.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Capcut Pro',
                'category' => 'Video Editing',
                'description' => 'Professional video editing tool.',
                'external_link' => 'https://files.modyolo.com/CapCut/CapCut%20Pro%20v13.9.0%20Mod.apk',
                'image' => 'capcut.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Andro Rat',
                'category' => 'Media',
                'description' => 'Remote administration tool.',
                'external_link' => '#',
                'image' => 'andro.jpg',
                'downloads_count' => 0,
                'status' => 'deactivated',
            ],
            [
                'name' => 'Pixel Lab Pro',
                'category' => 'Video Editing',
                'description' => 'Graphic design app.',
                'external_link' => 'https://files.modyolo.com/PixelLab/PixelLab%20v2.1.5%20Mod.apk',
                'image' => 'pixel.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Spotify Premium',
                'category' => 'Music',
                'description' => 'Premium music streaming.',
                'external_link' => 'https://files.modyolo.com/Spotify/Spotify%20Premium%20v8.10.12.10%20Mod.apk',
                'image' => 'spotify.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Nord VPN',
                'category' => 'VPN',
                'description' => 'Secure VPN service.',
                'external_link' => 'https://s1.spiderdown.com/old-data/NordVPN/NordVPN%20v6.30.1%20(Mod1).apk',
                'image' => 'nord.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Location Changer',
                'category' => 'Location',
                'description' => 'Change device location.',
                'external_link' => 'https://files.modyolo.com/Location%20Changer/Location%20Changer%20v3.34%20(Premium).apk',
                'image' => 'changer.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Netflix Premium',
                'category' => 'Streaming',
                'description' => 'Premium video streaming.',
                'external_link' => 'https://files.modyolo.com/Netflix/Netflix%20Premium%20v9.5.0%20Mod.apk',
                'image' => 'netflix.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Playit Pro',
                'category' => 'Media',
                'description' => 'Media player with premium features.',
                'external_link' => 'https://files.modyolo.com/PLAYit/PLAYit%20VIP%20v2.8.68.5%20Mod.apk',
                'image' => 'playit.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'WhatsApp Blue',
                'category' => 'Messaging',
                'description' => 'Customized WhatsApp version.',
                'external_link' => 'https://bluewhatsplus.com/download-official/',
                'image' => 'wa-blue.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Terabox Premium',
                'category' => 'Streaming',
                'description' => 'Cloud storage with premium features.',
                'external_link' => 'https://s1.spiderdown.com/Terabox/TeraBox%20v3.41.7_%28Premium%29.apk',
                'image' => 'terabox.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Shazam',
                'category' => 'Music',
                'description' => 'Music identification app.',
                'external_link' => 'https://files.modyolo.com/Shazam/Shazam%20v15.4.1.apk',
                'image' => 'shazam.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'FM WhatsApp',
                'category' => 'Messaging',
                'description' => 'Enhanced WhatsApp version.',
                'external_link' => 'https://files.modyolo.com/FM%20WhatsApp/WA10.10F_FouadMODS.apk',
                'image' => 'fm-wa.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'MX Player Pro',
                'category' => 'Media',
                'description' => 'Premium media player.',
                'external_link' => 'https://files.modyolo.com/MX%20Player%20Pro/MX-Player-%20v1.89.2.apk',
                'image' => 'mx-player.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'WhatsApp Gold',
                'category' => 'Messaging',
                'description' => 'Customized WhatsApp with premium features.',
                'external_link' => 'https://file.plusgbwhats.app/gold-whatsapp-downloading',
                'image' => 'wa-gold.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'YouTube Premium',
                'category' => 'Streaming',
                'description' => 'Premium video and music streaming.',
                'external_link' => 'https://files.modyolo.com/YouTube%20Music/YouTube%20Music%20Premium%20v7.40.52.apk',
                'image' => 'youtube.jpg',
                'downloads_count' => 0,
                'status' => 'active',
            ],
        ];

        foreach ($apps as $app) {
            FreeApp::create($app);
        }
    }
}