<?php

namespace App\Services;

use App\Category;

class CategoryService {

    /**
     * 获取类目树
     * @param $parentId 参数代表要获取子类目的父类目 ID，null 代表获取所有根类目
     * @param $allCategories 参数代表数据库中所有的类目，如果是 null 代表需要从数据库中查询
     * @return
     */
    public function getCategoryTree($parentId = null, $allCategories = null)
    {
        if (is_null($allCategories)){
            // 获取全部类目
            $allCategories = Category::all();
        }

        return $allCategories
            ->where('parent_id', $parentId)
            ->map(function(Category $category) use ($allCategories) {
                $data = ['id' => $category->id, 'name' => $category->name];
                if ($category->is_directory) {
                    $data['children'] = $this->getCategoryTree($category->id, $allCategories);
                }

                return $data;
            });

    }

}