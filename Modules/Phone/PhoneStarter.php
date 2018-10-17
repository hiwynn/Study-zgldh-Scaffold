<?php namespace Modules\Phone;

use App\Scaffold\Installer\ModelStarter;
use Modules\User\Models\User;

class PhoneStarter extends ModelStarter
{

    /**
     * ModelNameLikeThis
     * @return string
     */
    protected function modelName()
    {
        return 'Phone';
    }

    /**
     * table_name_like_this
     * @return string
     */
    protected function tableName()
    {
        return 'phone_list';
    }

    /**
     * [
     *      new Field()->label()->index()->required()->belongsTo().....,
     *      new Field()->label()->nullable().....
     * ]
     * @return array
     */
    protected function fields()
    {
        return [
            $this->newField('title', 'string')->label('名称')
                ->required()->unique()->factory($this->faker->unique()),
            $this->newField('description', 'text')->label('描述')
                ->inList()->factory($this->faker->realText()),
            $this->newField('phone_number', 'string')->label('号码')
                ->required()->unique()->factory($this->faker->unique()),
            $this->newField('status', 'integer')->label('状态')
                ->defaultValue(1)->inList(),
            $this->newField('find_counts', 'integer')->label('查找次数')
                ->defaultValue(0)->inList(),
            $this->newField('added_by', 'integer:unsigned')->label('创建者')
                ->nullable()->inList()->factory($this->faker->randomDigitNotNull)
                ->belongsTo(User::class, 'added_by', 'id'),
            $this->newField('updated_by', 'integer:unsigned')->label('更新者')
                ->nullable()->inList()->factory($this->faker->randomDigitNotNull)
                ->belongsTo(User::class, 'updated_by', 'id'),
        ];
    }

    /**
     * @return boolean
     */
    protected function needActivityLog()
    {
        return true;
    }

    /**
     * @return boolean
     */
    protected function isSoftDelete()
    {
        return true;
    }
}
