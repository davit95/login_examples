<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/18/2016
 * Time: 10:38 PM
 */
namespace App\Services;

use App\Contracts\CategoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Auth\Guard;




class CategoryService implements CategoryInterface
{
    protected $category;
    protected $user;

   public function __construct(Category $category, Guard $auth)
   {
        $this->category = $category;
        $this->user = $auth;
   }

    public function getAllCategories()
    {
        return $this->category->get();
    }

    public function getUsersCategories()
    {
        return $this->category->where('user_id', $this->user->id())->get();
    }

    public function showCategory($id)
    {
        return $this->category->find($id);
    }

    public function updateCategory($inputs, $id)
    {
        return $this->category->where('id',$id)->update($this->getInputs($inputs));
    }

    private function getInputs($data)
    {
        $inputs = ['category' => $data['category'], 'user_id' => $this->user->id()];
        return $inputs;
    }
}