<?php

namespace App\Admin\Controllers;

use App\Models\Album;
use App\Models\View;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ViewController extends Controller
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
            ->description('景点')
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
            ->description('景点')
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
            ->description('景点')
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
            ->description('景点')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new View);

        $grid->id('Id');
        $grid->name('名称');
        $grid->sort('排序');
        $grid->title('副标题');
        $grid->column('album.name', '相册');
        $grid->card_img('贺卡图')->image();

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
        $show = new Show(View::findOrFail($id));

        $show->id('Id');
        $show->name('名称');
        $show->sort('排序');
        $show->title('副标题');
        $show->album('相册', function ($album) {
            $album->name('名称');
        });
        $show->intro('简介');
        $show->card_img('贺卡图')->image();
        $show->card_intro('贺卡简介');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new View);

        $form->text('name', '名称');
        $form->number('sort', '排序');
        $form->text('title', '副标题');
        $form->select('album_id', '相册')->options($this->getAlbumSelect());
        $form->textarea('intro', '简介');
        $form->image('card_img','贺卡图')->uniqueName();
        $form->textarea('card_intro', '贺卡简介');

        return $form;
    }

    private function getAlbumSelect()
    {
        $c = Album::get();
        $s = [];
        foreach ($c as $v) {
            $s[$v->id] = $v->name;
        }
        return $s;
    }
}
