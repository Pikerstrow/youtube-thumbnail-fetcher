<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use App\ZipFileInfo;
use TCG\Voyager\Models\Permission;


class ZipFilesInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Data Type
        $dataType = $this->dataType('slug', 'zip_archives');
        if (!$dataType->exists) {
            $dataType->fill([
                'name' => 'zip_archives',
                'display_name_singular' => __('voyager::seeders.data_types.zip_archives.singular'),
                'display_name_plural' => __('voyager::seeders.data_types.zip_archives.plural'),
                'icon' => 'voyager-folder',
                'model_name' => ZipFileInfo::class,
                'generate_permissions' => 1,
                'description' => '',
            ])->save();
        }

        //Data Rows
        $archiveDataType = DataType::where('slug', 'zip_archives')->firstOrFail();
        $dataRow = $this->dataRow($archiveDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'order' => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($archiveDataType, 'file_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => __('voyager::seeders.data_rows.file_name'),
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'order' => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($archiveDataType, 'path');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => __('voyager::seeders.data_rows.path'),
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'order' => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($archiveDataType, 'url');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => __('voyager::seeders.data_rows.url'),
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'order' => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($archiveDataType, 'youtube_video_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => __('voyager::seeders.data_rows.youtube_video_id'),
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'order' => 5,
            ])->save();
        }


        $dataRow = $this->dataRow($archiveDataType, 'user_ip');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => __('voyager::seeders.data_rows.user_ip'),
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'order' => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($archiveDataType, 'thumbnails_info');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text_area',
                'display_name' => __('voyager::seeders.data_rows.thumbnails_info'),
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'order' => 6,
            ])->save();
        }


        $dataRow = $this->dataRow($archiveDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($archiveDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 8,
            ])->save();
        }


        //Menu Item
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title' => __('voyager::seeders.menu_items.zip_archives'),
            'url' => '',
            'route' => 'voyager.zip_archives.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => '_self',
                'icon_class' => 'voyager-folder',
                'color' => null,
                'parent_id' => null,
                'order' => 5,
            ])->save();
        }

        //Permissions
        Permission::generateFor('zip_archives');
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field' => $field,
        ]);
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
