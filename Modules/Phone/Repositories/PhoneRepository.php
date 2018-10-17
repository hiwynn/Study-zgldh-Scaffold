<?php namespace Modules\Phone\Repositories;

use Modules\Phone\Models\Phone;
use App\Scaffold\BaseRepository;

class PhoneRepository extends BaseRepository
{
    /**
     * @var  array
     */
    protected $fieldSearchable = [
        "title",
        "description",
        "phone_number",
        "status",
        "find_counts",
        "added_by",
        "updated_by"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Phone::class;
    }
}
