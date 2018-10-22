<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\WheelSimilarAction;
use App\Admin\Extensions\Tools\WheelSimilarTool;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Style;
use App\Models\Wheel;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class WheelController extends Controller
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
        $grid = new Grid(new Wheel());

        $grid->model()->with([
            'brand',
            'collection',
            'style'
        ]);

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->prepend(new WheelSimilarAction($actions->row));
        });

        $grid->filter(function (Grid\Filter $filter) {

            $brandFilter = $filter->equal('brand_id', 'Brand')
                ->select($this->ajaxSelect(Brand::class));

            $brandFilter->load('collection_id', route('cp.api.collections'));
            $brandFilter->ajax(route('cp.api.brands'));

            $filter->equal('collection_id', 'Collection')
                ->select($this->ajaxSelect(Collection::class));

            $filter->equal('style_id', 'Style')
                ->select(Style::options());

            $filter->like('name');

        });

        $grid->column('id', 'ID')
            ->sortable();

        $grid->column('brand.name', 'Brand')
            ->sortable();

        $grid->column('collection.name', 'Collection')
            ->sortable();

        $grid->column('style.name', 'Style')
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
        $model = Wheel::findOrFail($id);
        $show = new Show($model);

        $show->panel()->tools(function (Show\Tools $tools) use ($model) {
            $tools->append(new WheelSimilarTool($model));
        });

        $show->field('id', 'ID');
        $show->field('name');
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
        $form = new Form(new Wheel());

        $form->display('id', 'ID');

        $form->select('brand_id', 'Brand')
            ->options(function ($id) {
                return Brand::find($id)
                    ->pluck('name', 'id')
                    ->toArray();
            })
            ->ajax(route('cp.api.brands'));

        $form->select('collection_id', 'Collection')
            ->options(function ($id) {
                $model = Collection::find($id);

                if ($model) {
                    return $model->pluck('name', 'id')->toArray();
                }
            })
            ->ajax(route('cp.api.collections'));

        $form->select('style_id', 'Style')
            ->options(Style::options());

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
