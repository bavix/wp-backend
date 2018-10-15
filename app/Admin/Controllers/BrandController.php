<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Link;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BrandController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content): Content
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content): Content
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content): Content
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content): Content
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Brand());

        $grid->filter(function (Grid\Filter $filter) {
            $filter->like('name');
        });

        $grid->column('id', 'ID')
            ->sortable();

        $grid->column('name')
            ->sortable();

        $grid->column('enabled')->switch();

        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id): Show
    {
        $show = new Show(Brand::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Brand());

        $form->display('id', 'ID');

        $form->select('parent_id', 'Parent')
            ->options(function (?int $id) {
                if ($id) {
                    $brand = Brand::findOrFail($id);
                    return [$brand->id => $brand->name];
                }
            })
            ->ajax(route('cp.api.brands'));

        $form->text('name');
        $form->switch('enabled');

//        $form->hasMany('addresses', function (Form\NestedForm $nestedForm) {
//            $nestedForm->text('label', 'Address');
//            $nestedForm->hidden('latitude');
//            $nestedForm->hidden('longitude');
//            $nestedForm->map('latitude', 'longitude', 'Map');
//        });

        $form->hasMany('links', function (Form\NestedForm $nestedForm) {
            $nestedForm->url('url');
            $nestedForm->switch('enabled');
        });

        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        return $form;
    }
}
