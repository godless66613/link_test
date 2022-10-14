<?php
namespace App\Services;

use App\Models\Link;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

Class LinkService
{
    /**
     * @return Collection
     */
    public function getAllLinks(): \Illuminate\Database\Eloquent\Collection
    {
        $links = Link::all();

        return $links;
    }
    /**
     * @param $data
     * @return void
     */
    public function createLink($data): void
    {
        $now = Carbon::now();

        $faker = Factory::create();

        $data['token'] = $faker->regexify('[A-Z]{2}[a-z]{3}[0-4]{3}');

        $data['expired_at'] = $now->addHours($data['lifetime']);

        DB::transaction(function () use ($data)
        {
            $link = Link::create($data);

            if( !$link )
            {
                throw new \Exception('Link not created');
            }
        });
    }

    /**
     * @param $token
     * @return mixed
     */
    public function showLink($token): mixed
    {
        $link = Link::where('token',$token)->first();

        if(!$link)
        {
            abort(404);
        }
        $this->validate($link);

        $link->fill([
            'current_transfer_limit' => ++$link->current_transfer_limit,
        ]);

        $link->save();

        return $link->link;
    }

    /**
     * @param Link $link
     * @return void
     */
    private function validate(Link $link): void
    {
        $now = Carbon::now();

        if($link->transfer_limit)
        {
            if($link->current_transfer_limit >= $link->transfer_limit)
            {
                abort(404);
            }
        }

        if($now->gte($link->expired_at))
        {
            abort(404);
        }
    }

}
