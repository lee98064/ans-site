<?php

namespace App\Admin\Controllers;

use App\Models\Book;
use App\Models\Subject;
use App\Models\Publisher;
use App\Models\File;
use App\Models\Catalog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '書籍';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Book());
        $grid->quickSearch('name');
        // $grid->column('id', __('編號'));
        $grid->column('cover','封面')->image('', 100, 100);
        $grid->column('name', __('書名'));
        $grid->column('subject.name', __('科目'));
        $grid->column('publisher.name', __('出版社'));
        $grid->column('released','發布')->switch();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Book::findOrFail($id));

        $show->field('cover', __('封面'))->image();
        $show->field('name', '書名');
        $show->field('sid', '書號');
        $show->field('isbn', 'ISBN');
        $show->field('publish_year', '發售年');
        $show->field('publisher.name', '出版社');
        $show->field('describe', __('描述'));
        $show->field('created_at', __('建立日期'));
        $show->field('updated_at', __('更新日期'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Book());


        $form->column(1/3, function ($form) {
            $form->image('cover', '封面')->removable();
            
        });


        $form->column(2/3, function ($form) {
            $form->text('name', '書名');
            $form->text('sid', '書號');
            $form->text('isbn', 'ISBN');
            $form->text('publish_year', '發售年');
            $form->select('publisher_id', '出版社')->options(Publisher::getSelectOptions());
            $form->select('subject_id', '科目')->options(Subject::getSelectOptions());
            $form->textarea('describe', '描述')->rows(10);
            $form->switch('released', '發布？');
        });

        
        // $form->display('id');
        
        
        
        return $form;
    }
}
