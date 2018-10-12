<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * @var array
     */
    protected $roles = [
        'registered' => [
            'likes',
            'favorites',
        ],
        'user' => [
            'wheels',
            'brands',
            'collections',
            'addresses',
        ],
        'admin' => [
            'styles'
        ],
        'root' => [

        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $output = $this->command->getOutput();
        $progressBar = $output->createProgressBar(
            \count($this->roles, \COUNT_RECURSIVE)
        );

        $role = null;
        $prev = null;

        foreach ($this->roles as $name => $resources) {

            if ($role) {
                $prev = $role;
            }

            /**
             * @var $role \Yajra\Acl\Models\Role
             * @var $prev \Yajra\Acl\Models\Role
             */
            $role = \Yajra\Acl\Models\Role::query()->create([
                'name' => \Illuminate\Support\Str::title($name),
                'slug' => str_slug($name),
                'system' => true,
                'description' => "$name role.",
            ]);

            if ($prev) {
                $ids = $prev->permissions->pluck('id')->toArray();
                $role->syncPermissions($ids);
            }

            foreach ($resources as $resource) {
                /**
                 * @var $permissions \Yajra\Acl\Models\Permission[]
                 */
                $permissions = \Yajra\Acl\Models\Permission::createResource($resource);
                foreach ($permissions as $permission) {
                    $role->assignPermission($permission->getKey());
                    $progressBar->advance();
                }
            }
        }

        $output->newLine();
    }

}
