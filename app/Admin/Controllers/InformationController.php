<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Information;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class InformationController extends Controller
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
            ->header('列表')
            ->description('资讯')
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
            ->description('资讯')
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
            ->description('资讯')
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
            ->header('新增')
            ->description('资讯')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Information);

        $grid->id('Id');
        $grid->name('名称');
        $grid->column('category.name', '分类');
        $grid->label('标签');
        $grid->intro('简介');
        $grid->head_img('封面图')->image();
        $grid->type('跳转类型')->display(function ($type) {
            $t = [
                1  => '链接',
                2  => '长图',
                3  => '详情',
            ];
            return $t[$type];
        });
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
        $show = new Show(Information::findOrFail($id));

        $show->id('Id');
        $show->name('名称');
        $show->category('分类', function ($category) {
            $category->name('名称');

            $category->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableList();
                    $tools->disableDelete();
                });
        });
        $show->label('标签')->label();
        $show->intro('简介');
        $show->head_img('封面图')->image();
//        $show->type('跳转类型');
        $show->type('跳转类型')->as(function ($type) {
            $t = [
                1  => '链接',
                2  => '长图',
                3  => '详情',
            ];
            return $t[$type];
        });
        $show->link('链接');
        $show->long_img('长图')->image();
        $show->detail('详情');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Information);

        $form->text('name', '名称');
        $form->select('category_id', '分类')->options($this->getCategorySelect());

        $form->text('label', '标签');
        $form->textarea('intro', '简介');
        $form->image('head_img','封面图')->uniqueName();
        $type = [
            1  => '链接',
            2  => '长图',
            3  => '详情',
        ];
        $form->select('type', '类型')->options($type);
        $form->url('link', '链接')->rules('nullable');
        $form->image('long_img','长图')->uniqueName()->rules('nullable');
        $form->editor('detail', '详情')->rules('nullable');
        return $form;
    }

    private function getCategorySelect()
    {
        $c = Category::get();
        $s = [];
        foreach ($c as $v) {
            $s[$v->id] = $v->name;
        }
        return $s;
    }
}
