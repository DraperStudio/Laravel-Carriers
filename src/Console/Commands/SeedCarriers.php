<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Carriers.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Carriers\Console\Commands;

use Artisanry\Carriers\Models\Carrier;
use DB;
use Illuminate\Console\Command;

class SeedCarriers extends Command
{
    /**
     * @var string
     */
    protected $name = 'carriers:seed';

    /**
     * @var string
     */
    protected $description = 'Command description.';

    public function fire()
    {
        DB::table('carriers')->delete();

        $data = base_path('vendor/faustbrian/mobile-codes/dist/unsorted/data.json');
        $data = file_get_contents($data);
        $carriers = json_decode($data, true);

        foreach ($carriers as $country) {
            Carrier::create($country);
        }

        $this->info('Carriers seeded!');
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        return [];
    }
}
