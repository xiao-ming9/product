<?php

namespace App\Admin\Controllers;

use App\Good;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GoodController extends Controller
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
            ->header('商品表')
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
            ->header('编辑')
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
        $grid = new Grid(new Good);

        $grid->id('Id');
        $grid->name('名称');
        $grid->type('一级分类')->name('一级分类');
        $grid->secondType('二级分类')->name('二级分类');
        $grid->thirdType('三级分类')->name('三级分类');
        $grid->brand('品牌');
        $grid->capacity('容量');
        $grid->category('类别');
        $grid->characteristic('特点');
        $grid->shape('形状');
        $grid->standard('规格');
        $grid->img('Img');
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
        $show = new Show(Good::findOrFail($id));

        $show->id('Id');
        $show->name('名称');
        $show->type_id('一级分类');
        $show->secondtype_id('二级分类');
        $show->thirdtype_id('三级分类');
        $show->brand('品牌');
        $show->capacity('容量');
        $show->category('类别');
        $show->characteristic('特点');
        $show->shape('形状');
        $show->standard('规格');
        $show->img('Img');
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
        $form = new Form(new Good);

        $form->text('name', '名称');
        //$form->number('type_id', '一级分类');
        //$form->number('secondtype_id', '二级分类');
        //$form->number('thirdtype_id', ' 三级分类');
        $form->select('type_id','一级分类')->options([
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
        $form->select('secondtype_id','二级分类')->options('/api/secondtype');
        $form->select('thirdtype_id','三级分类')->options('/api/thirdtype');
        $form->text('brand', '品牌');
        $form->text('capacity', '容量');
        $form->text('category', '类别');
        $form->text('characteristic', '特点');
        $form->text('shape', '形状');
        $form->text('standard', '规格');
        $form->image('img', 'Img');
        
        return $form;
    }
}
