<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\TagContract;

class TagTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $tags = [
        'Scoala', 'Sanatate', 'Market', 'Servicii', 'Internet', 'Mancare', 'Justitie'
    ];

    /**
     * @var TagContract
     */
    private $tag;

    /**
     * @param TagContract $tag
     * @internal param PersonService $person
     */
    public function __construct(TagContract $tag)
    {
        $this->tag = $tag;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tags as $tag)
        {
            $wasCreated = $this->tag->create([
                'name' => $tag
            ]);
            echo ! $wasCreated ?: sprintf('%s tag created !%s', $tag, PHP_EOL);
        }
    }

}
