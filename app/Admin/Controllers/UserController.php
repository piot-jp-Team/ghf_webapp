<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->email(trans('user.email'))->sortable();
            $grid->name(trans('admin.name'))->sortable();

            $grid->created_at();
            $grid->updated_at();


            $grid->filter(function($filter){

                // Remove the default id filter
                $filter->disableIdFilter();

                // Add a column filter   
                $filter->like('email', trans('user.email'));
                $filter->like('name', trans('user.name'));
            });



        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->email('email', trans('user.email'))->rules('required');
            $form->text('name', trans('user.name'))->rules('required');
            $form->password('password', trans('user.password'))->rules(function ($form) {
                // If it is not an edit state, add field unique verification
                if (!$form->model()->password) {
                    return 'required';
                }
                else {
                    if (!Request::input('password')) {
                        $form->ignore(['password']);
                    }
                    return '';
                }
            })->help(trans('help.Please input only when you want to change the password.'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                }
            });
        });
    }
}
