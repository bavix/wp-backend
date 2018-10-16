<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Collection;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CollectionController extends Controller
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
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Collection());

        $grid->model()->with([
            'brand'
        ]);

        $grid->filter(function (Grid\Filter $filter) {
            $filter->equal('brand_id', 'Brand')
                ->select()
                ->ajax(route('cp.api.brands'));

            $filter->like('name');
        });

        $grid->column('id', 'ID')
            ->sortable();

        $grid->column('brand.name', 'Brand')
            ->sortable();

        $grid->column('name')
            ->sortable();

        $grid->column('enabled')->switch();

        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');

        return $grid;
    }

    /**
     * Show interface.
     *
     * @param mixed $id
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
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id): Show
    {
        $show = new Show(Collection::findOrFail($id));

        $show->getModel()->load('brand');

        $show->field('id', 'ID');
        $show->field('name', 'Name');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');

        return $show;
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
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
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Collection());

        $form->display('id', 'ID');

        $form->select('brand_id', 'Brand')
            ->options(function ($id) {
                return Brand::find($id)
                    ->pluck('name', 'id')
                    ->toArray();
            })
            ->ajax(route('cp.api.brands'));

        $form->text('name');
        $form->switch('enabled');

        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        return $form;
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
}
