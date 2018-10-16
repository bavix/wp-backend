<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
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
        $grid = new Grid(new User());

        $grid->filter(function (Grid\Filter $filter) {
            $filter->equal('login');
            $filter->like('name');
            $filter->equal('email');
        });

        $grid->column('id', 'ID')
            ->sortable();

        $grid->column('login')
            ->sortable();

        $grid->column('name')
            ->sortable();

        $grid->column('email')
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('login');
        $show->field('name');
        $show->field('email');
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
            ->body($this->form($id)->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @param int $id
     *
     * @return Form
     */
    protected function form(?int $id = null): Form
    {
        $form = new Form(new User());

        $form->display('id', 'ID');

        $form->text('login');
        $form->text('name');
        $form->email('email');

        if (!$id) {
            $form->password('password');
        }

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
