<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Style;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class StyleController extends Controller
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
        $grid = new Grid(new Style());

        $grid->filter(function (Grid\Filter $filter) {
            $filter->equal('type')->select(Style::types());
            $filter->equal('number')->select(Style::numbers());
            $filter->equal('spoke')->integer();
            $filter->equal('rotated')->radio([
                '' => 'All',
                0 => 'Not rotated',
                1 => 'Rotated',
            ]);
        });

        $grid->column('id', 'ID')
            ->sortable();

        $grid->column('type')
            ->sortable();

        $grid->column('number')
            ->sortable();

        $grid->column('spoke')
            ->sortable();

        $grid->column('rotated')->switch();
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
        $show = new Show(Style::findOrFail($id));

        $show->field('id', 'ID');

        $show->field('type');
        $show->field('number');
        $show->field('spoke');

        $show->field('rotated');
        $show->field('enabled');

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
        $form = new Form(new Style());

        $form->display('id', 'ID');

        $form->select('type')->options(Style::types());
        $form->select('number')->options(Style::numbers());
        $form->number('spoke');

        $form->switch('rotated');
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
