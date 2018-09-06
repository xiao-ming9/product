<?php

namespace App\Admin\Controllers;

use App\Apply;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ApplyController extends Controller
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
            ->header('合作申请')
            ->description('')
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
        $grid = new Grid(new Apply);

        $grid->id('Id');
        $grid->name('Name');
        $grid->cname('Cname');
        $grid->address('Address');
        $grid->phone('Phone');
        $grid->type('Type');
        $grid->intro('Intro');
        $grid->license('License');
        $grid->content('Content');
        $grid->property('Property');
        $grid->fund('Fund');
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
        $show = new Show(Apply::findOrFail($id));

        $show->id('Id');
        $show->cname('Cname');
        $show->address('Address');
        $show->name('Name');
        $show->phone('Phone');
        $show->type('Type');
        $show->intro('Intro');
        $show->license('License');
        $show->content('Content');
        $show->property('Property');
        $show->fund('Fund');
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
        $form = new Form(new Apply);

        $form->text('cname', 'Cname');
        $form->text('address', 'Address');
        $form->text('name', 'Name');
        $form->number('phone', 'Phone');
        $form->text('type', 'Type');
        $form->textarea('intro', 'Intro');
        $form->text('license', 'License');
        $form->text('content', 'Content');
        $form->text('property', 'Property');
        $form->text('fund', 'Fund');

        return $form;
    }
}
