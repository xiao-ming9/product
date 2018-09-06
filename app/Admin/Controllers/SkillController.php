<?php

namespace App\Admin\Controllers;

use App\Skill;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SkillController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
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
    public function show($id, Content $content)
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
    public function edit($id, Content $content)
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
    public function create(Content $content)
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
    protected function grid()
    {
        $grid = new Grid(new Skill);

        $grid->id('Id');
        $grid->cname('Cname');
        $grid->name('Name');
        $grid->phone('Phone');
        $grid->email('Email');
        $grid->product('Product');
        $grid->content('Content');
        $grid->spec_email('Spec email');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Skill::findOrFail($id));

        $show->id('Id');
        $show->cname('Cname');
        $show->name('Name');
        $show->phone('Phone');
        $show->email('Email');
        $show->product('Product');
        $show->content('Content');
        $show->spec_email('Spec email');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Skill);

        $form->text('cname', 'Cname');
        $form->text('name', 'Name');
        $form->number('phone', 'Phone');
        $form->email('email', 'Email');
        $form->text('product', 'Product');
        $form->text('content', 'Content');
        $form->text('spec_email', 'Spec email');

        return $form;
    }
}
