<?php

namespace App\Admin\Controllers;

use App\SecondType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SecondTypeController extends Controller
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
            ->header('二级分类')
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
            ->header('详情')
            ->description('')
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
            ->header('修改')
            ->description('')
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
            ->header('创建')
            ->description('')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SecondType);
        $grid->id('Id');
        $grid->name('名称');
        $grid->type_id('父级分类')->using([
             1 => '容器',
             2 => '计量器具/实验器具/耗材', 
             3 => '实验用品/材料/试剂',
             4 => '通用仪器/实验仪器',
             5 => '理化前处理',
             6 => '理化分析',
             7 => '环境检测与分析',
             8 => '工业微生物检测',
             9 => '临床诊断',
             10 => '个人防护产品系列'
            ]);
        //$grid->type_id('Type id');
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
        $show = new Show(SecondType::findOrFail($id));
        
        $show->id('Id');
        $show->name('Name');
        $show->type_id('Type id');
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
        $form = new Form(new SecondType);
        $form->text('name', '名称');
        $form->select('type_id','父级分类')->options([
             1 => '容器',
             2 => '计量器具/实验器具/耗材', 
             3 => '实验用品/材料/试剂',
             4 => '通用仪器/实验仪器',
             5 => '理化前处理',
             6 => '理化分析',
             7 => '环境检测与分析',
             8 => '工业微生物检测',
             9 => '临床诊断',
             10 => '个人防护产品系列'
            ]);
        //$form->number('type_id', '一级分类');

        return $form;
    }
}
