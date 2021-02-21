<?php

namespace App\Admin\Controllers;

use App\Models\File;
use App\Models\Book;
use App\Models\Catalog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Storage;

class FileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'File';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new File());

        $grid->column('id', '編號');
        $grid->column('book_id', '書本')->display(function($book_id){
            return Book::find($book_id)->name;
        });

        $grid->column('path','檔案')->display(function($path) {
            $name = "";
            foreach ($path as $file) {
                $name .= "<a target='_blank' href='" . Storage::disk('admin')->url($file) . "'>" . basename($file) . "</a><br>";
            }
            return $name;
        });;
        
        $grid->column('catalog_id', '類別')->display(function($catalog_id){
            return Catalog::find($catalog_id)->name;
        });
        
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(File::findOrFail($id));

        $show->field('id', __('Id'));
        // $show->field('name', __('Name'));
        // $show->field('origin_name', __('Origin name'));
        // $show->field('size', __('Size'));
        // $show->field('path', __('Path'));
        // $show->field('book_id', __('Book id'));
        // $show->field('catalog_id', __('Catalog id'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new File());

        $form->select('book_id', '書籍')->options(Book::getSelectOptions())->required();
        $form->select('catalog_id', '分類')->options(Catalog::getSelectOptions());
        $form->multipleFile('path','檔案')->move(function($form){
            return '/files/' . dump($form->book_id);
        })->removable()->name(function ($file){
            return $file->getClientOriginalName();
        });

        return $form;
    }
}
